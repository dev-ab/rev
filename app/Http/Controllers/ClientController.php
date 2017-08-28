<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use JavaScript;

class ClientController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $clients = \App\Client::all();
        $types = ['individual' => 'شركه فرديه', 'limited' => 'شركه محدوده', 'solidarity' => 'شركه تضامن', 'contributory' => 'شركه مساهمه'];
        $zakkat = ['zakkat' => 'زكاه', 'tax' => 'ضريبه', 'mixed' => 'مختلطه'];
        $clients->load(['contacts' => function($query) {
                $query->where('type', 'phone');
            }]);

        return view('client-preview', compact('clients', 'types', 'zakkat'));
    }

    public function create() {
        return view('client');
    }

    public function balance($id) {
        $client = \App\Client::with(['trialBalance.workPoint'])->findOrFail($id);

        JavaScript::put([
            'client' => $client,
            'workPoints' => \App\WorkPoint::where(['level' => 1])
                    ->with([
                        'children.children.children',
                        'children.children.children.trialBalance' => function($q) use($client) {
                            return $q->where('client_id', $client->id);
                        }])->get()
        ]);

        return view('balance');
    }

    public function balanceSave(Request $request, $id) {
        $data = json_decode($request->input('data'), true);
        $client = \App\Client::with('trialBalance')->findOrFail($id);
        $ids = $client->trialBalance->pluck('work_point_id')->toArray();

        $error = false;

        foreach ($data as $p) {
            if (in_array($p['id'], $ids)) {
                unset($ids[array_search($p['id'], $ids)]);
                $filtered = array_filter($p, function($v, $k) {
                    if (in_array($k, ['initial_debit', 'initial_credit', 'move_debit', 'move_credit']) && $v)
                        return true;
                    return false;
                }, ARRAY_FILTER_USE_BOTH);
                $client->trialBalance()->where('work_point_id', $p['id'])->update($filtered);
            } else {
                $p['work_point_id'] = $p['id'];
                if (substr($p['id'], 0, 4) == 'null') {
                    if (!empty($p['number']) && !empty($p['name'])) {
                        $temp = \App\WorkPoint::create($p);
                        $p['work_point_id'] = $temp->id;
                        $p['name'] = '';
                        $client->trialBalance()->create($p);
                    } else {
                        $error = true;
                    }
                } else {
                    $p['name'] = '';
                    $client->trialBalance()->create($p);
                }
            }
        }

        $wps = \App\WorkPoint::whereIn('id', $ids)->get();

        print_r($wps);
        
        foreach ($wps as $wp) {
            if ($wp->initial == 0)
                $wp->delete();
            $client->trialBalance()->where('work_point_id', $wp->id)->delete();
        }

        if ($error)
            return response()->json(['saved' => false]);

        return response()->json(['saved' => true]);
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $client = \App\Client::find($id);

        if (!$client)
            return redirect()->action('ClientController@index')->with($msg);
        else
            $client->load('contacts', 'partners', 'reps', 'auditors', 'attachments');

        $contacts = $client->contacts->groupBy('type')->toArray();
        $client->phones = $contacts['phone'];
        $client->faxes = isset($contacts['fax']) ? $contacts['fax'] : [];
        $client->emails = $contacts['email'];
        $client->websites = isset($contacts['website']) ? $contacts['website'] : [];

        JavaScript::put(['client' => $client]);

        return view('client', compact('client'));
    }

    public function save(Request $request) {
        $id = $request->input('id');
        $data = $request->input();

        $validations = $this->validation_rules();

        $this->validate($request, $validations[0], $validations[1]);

        $msg = ['status' => 'nothing'];
        $client = \App\Client::find($id);

        if ($id == 'null') {
            $client = \App\Client::create($data);
            $msg = ['status' => 'created'];
        } else if ($client) {
            $client->update($data);
            $msg = ['status' => 'updated'];
        }

        $contacts_ids = $client->contacts->pluck('id')->toArray();
        $contacts_data = array_merge($data['company_phone'], $data['company_fax'], $data['company_email'], $data['company_website']);
        foreach ($contacts_data as $contact) {
            if (!empty($contact['data'])) {
                if ($contact['id'] == 'null') {
                    $client->contacts()->create($contact);
                } else {
                    $temp = \App\Contact::find($contact['id']);
                    if ($temp) {
                        $temp->update($contact);
                        unset($contacts_ids[array_search($temp->id, $contacts_ids)]);
                    }
                }
            }
        }
        \App\Contact::whereIn('id', $contacts_ids)->delete();


        $partners_ids = $client->partners->pluck('id')->toArray();
        foreach ($data['partners'] as $partner) {
            if (!empty($partner['name'])) {
                if ($partner['id'] == 'null') {
                    $client->partners()->create($partner);
                } else {
                    $temp = \App\Partner::find($partner['id']);
                    if ($temp) {
                        $temp->update($partner);
                        unset($partners_ids[array_search($temp->id, $partners_ids)]);
                    }
                }
            }
        }
        \App\Partner::whereIn('id', $partners_ids)->delete();


        $reps_ids = $client->reps->pluck('id')->toArray();
        foreach ($data['reps'] as $rep) {
            if (!empty($rep['name'])) {
                if ($rep['id'] == 'null') {
                    $client->reps()->create($rep);
                } else {
                    $temp = \App\Representative::find($rep['id']);
                    if ($temp) {
                        $temp->update($rep);
                        unset($reps_ids[array_search($temp->id, $reps_ids)]);
                    }
                }
            }
        }
        \App\Representative::whereIn('id', $reps_ids)->delete();


        $auds_ids = $client->auditors->pluck('id')->toArray();
        foreach ($data['auds'] as $aud) {
            if (!empty($aud['name'])) {
                if ($aud['id'] == 'null') {
                    $client->auditors()->create($aud);
                } else {
                    $temp = \App\Auditor::find($aud['id']);
                    if ($temp) {
                        $temp->update($aud);
                        unset($auds_ids[array_search($temp->id, $auds_ids)]);
                    }
                }
            }
        }

        \App\Auditor::whereIn('id', $auds_ids)->delete();

        $files = $request->only('attachments')['attachments'];

        foreach ($files as $file) {
            if (isset($file['file'])) {
                $res = fopen($file['file']->path(), 'r+');
                $filename = "client/{$client->id}/" . $file['file']->getClientOriginalName();
                Storage::disk()->put($filename, $res);
                $client->attachments()->create(['name' => $file['name'], 'path' => $filename, 'sizeKB' => round($file['file']->getClientSize() / 1024, 2), 'type' => $file['file']->getClientMimeType()]);
            }
        }

        return response()->json(['saved' => true, 'client_id' => $client->id]);

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    protected function delete_att($id) {
        $att = \App\Attachment::findOrFail($id);
        Storage::delete($att->path);
        $att->delete();
        return response()->json();
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($client = \App\Client::find($id)) {
            $client->contacts()->delete();
            $client->partners()->delete();
            $client->reps()->delete();
            $client->auditors()->delete();
            foreach ($client->attachments as $att) {
                Storage::delete($att->path);
                $att->delete();
            }
            $client->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('ClientController@index')->with($msg);
    }

    protected function validation_rules() {

        $rules = [
            'company_name' => 'required|max:191',
            'company_activity' => 'required|max:191',
            'company_address' => 'required|max:191',
            'company_register_number' => 'required|numeric',
            'company_register_expiration' => 'required|date_format:Y-m-d',
            'company_financial_year' => 'required|date_format:Y-m-d',
            'company_apparent_capital' => 'required|numeric',
            'company_money_capital' => 'required|numeric',
            'company_total_capital' => 'required|numeric',
            'company_type' => 'required',
            'company_zakkat' => 'required',
            'company_phone.0.data' => 'required',
            'company_phone.*.data' => 'digits_between:8,15',
            'company_email.0.data' => 'required',
            'company_email.*.data' => 'email',
            'company_fax.*.data' => 'nullable|digits_between:8,15',
            'partners.*.phone' => 'nullable|digits_between:8,15',
            'partners.*.email' => 'nullable|email',
            'partners.*.fax' => 'nullable|digits_between:8,15',
            'partners.*.percentage' => 'nullable|numeric',
            'reps.*.phone' => 'nullable|digits_between:8,15',
            'reps.*.email' => 'nullable|email',
            'reps.*.fax' => 'nullable|digits_between:8,15',
            'auds.*.phone' => 'nullable|digits_between:8,15',
            'auds.*.email' => 'nullable|email',
            'auds.*.fax' => 'nullable|digits_between:8,15',
        ];

        $messages = [
            //required
            'company_name.required' => 'يجب ادخال اسم الشركة',
            'company_activity.required' => 'يجب ادخال نشاط الشركة',
            'company_address.required' => 'يجب ادخال عنوان الشركة',
            'company_register_number.required' => 'يجب ادخال رقم السجل التجارى',
            'company_register_expiration.required' => 'يجب ادخال تاريخ انتهاء السجل التجارى',
            'company_financial_year.required' => 'يجب ادخال تاريخ السنه الماليه',
            'company_apparent_capital.required' => 'يجب ادخال رأس المال العينى',
            'company_money_capital.required' => 'يجب ادخال رأس المال النقدى',
            'company_total_capital.required' => 'يجب ادخال اجمالى رأس المال',
            'company_type.required' => 'يجب اختيار نوع الشركة',
            'company_zakkat.required' => 'يجب اختيار نوع المعامله الزكويه',
            'company_phone.0.data.required' => 'يجب ادخال رقم هاتف واحد على الأقل',
            'company_email.0.data.required' => 'يجب ادخال بريد الكترونى واحد على الأقل',
            //max 191
            'company_name.max' => 'يجب ان لا يتعدى اسم الشركة 191 حرف',
            'company_activity.max' => 'يجب ان لا يتعدى نضاط الشركة 191 حرف',
            'company_address.max' => 'يجب ان لا يتعدى عنوان الشركة 191 حرف',
            //'company_register_number.max' => 'يجب ان لا يتعدى رقم السجل التجارى 191 رقم',
            //'company_apparent_capital.max' => 'يجب ان لا يتعدى رأس المال العينى 191 رقم',
            //'company_money_capital.max' => 'يجب ان لا يتعدى رأس المال النقدى 191 رقم',
            //'company_total_capital.max' => 'يجب ان لا يتعدى اجمالى رأس المال  191 رقم',
            //numeric
            'company_register_number.numeric' => 'السجل التجارى يجب أن يكون رقم',
            'company_apparent_capital.numeric' => 'رأس المال العينى يجب أن يكون رقم',
            'company_money_capital.numeric' => 'رأس المال النقدى يجب أن يكون رقم',
            'company_total_capital.numeric' => 'اجمالى رأس المال يجب أن يكون رقم',
            //digits_between
            'company_phone.*.data.digits_between' => 'رقم الهاتف يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'company_fax.*.data.digits_between' => 'رقم الفاكس يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'partners.*.phone.digits_between' => '(الشركاء) رقم الهاتف يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'partners.*.fax.digits_between' => '(الشركاء) رقم الفاكس يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'reps.*.phone.digits_between' => '(ممثلين الشركه) رقم الهاتف يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'reps.*.fax.digits_between' => '(ممثلين الشركه) رقم الفاكس يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'auds.*.phone.digits_between' => '(المراجعين) رقم الهاتف يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            'auds.*.fax.digits_between' => '(المراجعين) رقم الفاكس يجب أن يكون رقم صحيح بين 8 الى 15 رقم',
            //custom
            'company_register_expiration.date_format' => 'تاريخ انتهاء السجل غير صحيح',
            'company_financial_year.date_format' => 'تاريخ السنه الماليه غير صحيح',
            'company_email.*.data.email' => 'أدخل البريد الالكترونى بشكل صحيح',
            'partners.*.email' => '(الشركاء) أدخل البريد الالكترونى بشكل صحيح',
            'partners.*.percentage' => '(الشركاء) نسبة رأس المال يجب أن تكون رقم',
            'reps.*.email' => '(ممثلين الشركه) أدخل البريد الالكترونى بشكل صحيح',
            'auds.*.email' => '(المراجعين) أدخل البريد الالكترونى بشكل صحيح',
        ];

        return [$rules, $messages];
    }

}
