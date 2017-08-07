<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $groups = \App\Group::all();
        return view('group-preview', compact('groups'));
    }

    public function create() {
        $programs = \App\Program::with('objs')->get();

        JavaScript::put(['programs' => $programs]);

        return view('group');
    }

    public function edit($id) {
        $msg = ['status' => 'nothing'];
        $group = \App\Group::find($id);

        if (!$group)
            return redirect()->action('GroupController@index')->with($msg);
        else
            $group->load('objs');

        $programs = \App\Program::with('objs')->get();

        JavaScript::put([
            'group' => $group,
            'programs' => $programs
        ]);

        return view('group', compact('group'));
    }

    public function save(Request $request) {
        $id = $request->input('id');
        $data = $request->input();

        $group = \App\Group::find($id);

        if ($group)
            $validations = $this->validation_rules(false, $group->id);
        else
            $validations = $this->validation_rules();

        $this->validate($request, $validations[0], $validations[1]);

        $msg = ['status' => 'nothing'];

        if ($id == 'null') {
            $group = \App\Group::create($data);
            $msg = ['status' => 'created'];
        } else if ($group) {
            $group->update($data);
            $msg = ['status' => 'updated'];
        }

        if (is_array($data['objs']))
            $group->objs()->sync(array_reduce($data['objs'], 'array_merge', []));

        return;

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($group = \App\Group::find($id)) {
            $group->objs()->sync([]);

            $group->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->back()->with($msg);
    }

    protected function validation_rules($new = true, $id = null) {

        $rules = [
            'name' => 'required|unique:groups|max:191',
            'objs' => 'required',
        ];

        if (!$new)
            $rules['name'] = "required|unique:groups,name,{$id}|max:191";

        $messages = [
            'name.required' => 'يجب ادخال اسم المجموعة',
            'name.unique' => 'تم استخدام اسم المجموعة من قبل',
            'name.max' => 'يجب ان لا يتعدى اسم المجموعة 191 حرف',
            'objs.required' => 'يجب اختيار هدف واحد على الأقل',
        ];

        return [$rules, $messages];
    }

}
