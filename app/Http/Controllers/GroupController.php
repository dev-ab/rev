<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $groups = \App\Group::all();
        $objectives = \App\TaskObjective::all()->groupBy('category_id');
        return view('group', compact('groups', 'objectives'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $group = \App\Group::find($id);

        if (!$group)
            return redirect()->action('GroupController@index')->with($msg);

        $objectives = \App\TaskObjective::all()->groupBy('category_id');

        return view('group_edit', compact('group', 'objectives'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        $group = \App\Group::find($id);

        $objs = is_array($request->input('objs')) ? $request->input('objs') : [];

        if ($id == 'null') {
            $group = \App\Group::create($request->all());
            $group->objectives()->sync($objs);
            $msg = ['status' => 'created'];
        } else if ($group) {
            $group->update($request->all());
            $group->objectives()->sync($objs);
            $msg = ['status' => 'updated'];
        }

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($group = \App\Group::find($id)) {
            $group->objectives()->sync([]);
            $group->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('GroupController@index')->with($msg);
    }

}
