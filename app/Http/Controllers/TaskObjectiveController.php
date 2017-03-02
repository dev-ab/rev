<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskObjectiveController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $taskObjs = \App\TaskObjective::all();
        $cats = \App\Category::all();

        return view('taskObj', compact('taskObjs', 'cats'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $taskObj = \App\TaskObjective::find($id);

        if (!$taskObj)
            return redirect()->action('TaskObjectiveController@index')->with($msg);

        $cats = \App\Category::all();

        return view('taskObj_edit', compact('taskObj', 'cats'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        $taskObj = \App\TaskObjective::find($id);

        $data = $request->all();

        if (!isset($data['constant']))
            $data['constant'] = 0;

        if ($id == 'null') {
            $taskObj = \App\TaskObjective::create($data);
            $msg = ['status' => 'created'];
        } else if ($taskObj) {
            $taskObj->update($data);
            $msg = ['status' => 'updated'];
        }

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];
        $taskObj = \App\TaskObjective::find($id);

        if ($taskObj) {
            $taskObj->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('TaskObjectiveController@index')->with($msg);
    }

}
