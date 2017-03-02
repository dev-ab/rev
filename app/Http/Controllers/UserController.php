<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $users = \App\User::whereHas('roles', function($q) {
                    $q->where('name', '!=', 'admin');
                })->get();

        $roles = \App\Role::where('name', '!=', 'admin')->get();

        return view('user', compact('users', 'roles'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $user = \App\User::find($id);

        if (!$user || $user->roles[0]->name == 'admin')
            return redirect()->action('UserController@index')->with($msg);

        $roles = \App\Role::where('name', '!=', 'admin')->get();

        return view('user_edit', compact('user', 'roles'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        $user = \App\User::find($id);

        if ($id == 'null') {
            $user = \App\User::create($request->all());
            $user->roles()->sync([$request->input('role')]);
            $msg = ['status' => 'created'];
        } else if ($user && $user->roles[0]->name != 'admin') {
            $user->update($request->all());
            $user->roles()->sync([$request->input('role')]);
            $msg = ['status' => 'updated'];
        }

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];
        $user = \App\User::find($id);

        if ($user && $user->roles[0]->name != 'admin') {
            $user->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('UserController@index')->with($msg);
    }

}
