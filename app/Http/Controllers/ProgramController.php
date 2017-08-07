<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use JavaScript;

class ProgramController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $programs = \App\Program::all();
        return view('program-preview', compact('programs'));
    }

    public function create() {
        return view('program');
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $program = \App\Program::find($id);

        if (!$program)
            return redirect()->action('ProgramController@index')->with($msg);
        else
            $program->load('objs');

        JavaScript::put(['program' => $program]);

        return view('program', compact('program'));
    }

    public function save(Request $request) {
        $id = $request->input('id');
        $data = $request->input();

        $program = \App\Program::find($id);

        if ($program)
            $validations = $this->validation_rules(false, $program->id);
        else
            $validations = $this->validation_rules();

        $this->validate($request, $validations[0], $validations[1]);

        $msg = ['status' => 'nothing'];

        if ($id == 'null') {
            $program = \App\Program::create($data);
            $msg = ['status' => 'created'];
        } else if ($program) {
            $program->update($data);
            $msg = ['status' => 'updated'];
        }

        $objs = $program->objs->pluck('id')->toArray();
        foreach ($data['objs'] as $obj) {
            if (!empty($obj['description'])) {
                if ($obj['id'] == 'null') {
                    $program->objs()->create($obj);
                } else {
                    $temp = \App\ProgramObjective::find($obj['id']);
                    if ($temp) {
                        $temp->update($obj);
                        unset($objs[array_search($temp->id, $objs)]);
                    }
                }
            }
        }
        \App\ProgramObjective::whereIn('id', $objs)->delete();
        return;

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($program = \App\Program::find($id)) {
            $program->objs()->delete();

            $program->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->back()->with($msg);
    }

    protected function validation_rules($new = true, $id = null) {

        $rules = [
            'name' => 'required|unique:programs|max:191',
            'objs.0.description' => 'required',
        ];

        if (!$new)
            $rules['name'] = "required|unique:programs,name,{$id}|max:191";

        $messages = [
            'name.required' => 'يجب ادخال اسم البرنامج',
            'name.unique' => 'تم استخدام اسم البرنامح من قبل',
            'name.max' => 'يجب ان لا يتعدى اسم البرنامج 191 حرف',
            'objs.0.description.required' => 'يجب ادخال هدف واحد على الأقل',
        ];

        return [$rules, $messages];
    }

}
