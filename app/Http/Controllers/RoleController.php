<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $perms = \App\Permission::all();
        return view('role', compact('perms'));
    }

    public function view() {
        $roles = \App\Role::where('name', '!=', 'admin')->get();
        return view('roles-view', compact('roles'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $role = \App\Role::find($id);

        if (!$role || $role->name == 'admin')
            return redirect()->action('RoleController@index')->with($msg);

        $perms = \App\Permission::all();

        return view('role_edit', compact('role', 'perms'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        $role = \App\Role::find($id);

        $data = $request->all();

        print_r($data);

        if (isset($data['name']))
            $data['name'] = strtolower(str_replace(' ', '_', $data['name']));


        $perms = is_array($request->input('perms')) ? $request->input('perms') : [];

        if ($id == 'null') {
            $role = \App\Role::create($data);
            $role->perms()->sync($perms);
            $msg = ['status' => 'created'];
        } else if ($role && $role->name != 'admin') {
            $role->update($data);
            $role->perms()->sync($perms);
            $msg = ['status' => 'updated'];
        }

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($role = \App\Role::find($id)) {
            $role->perms()->sync([]);
            $role->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('RoleController@view')->with($msg);
    }

}
