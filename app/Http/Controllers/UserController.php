<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $roles = \App\Role::where('name', '!=', 'admin')->get();
        return view('user', compact('roles'));
    }

    public function view() {
        $users = \App\User::whereHas('roles', function($q) {
                    $q->where('name', '!=', 'admin');
                })->get();

        return view('users-view', compact('users'));
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
        $data = $request->all();

        $msg = ['status' => 'nothing'];
        $user = \App\User::find($id);

        //validate inputs
        if ($user)
            $validations = $this->validation_rules(false, $user->id);
        else
            $validations = $this->validation_rules();
        $this->validate($request, $validations[0], $validations[1]);

        if (empty($data['password']))
            unset($data['password']);
        else
            $data['password'] = bcrypt($data['password']);

        if (empty($data['phone']))
            $data['phone'] = '';

        if ($id == 'null') {
            $user = \App\User::create($data);
            $user->roles()->sync([$data['role']]);
            $msg = ['status' => 'created'];
        } else if ($user && $user->roles[0]->name != 'admin') {
            $user->update($data);
            $user->roles()->sync([$data['role']]);
            $msg = ['status' => 'updated'];
        }


        if (isset($data['image']) && $user) {
            $res = fopen($data['image']->path(), 'r+');
            $filename = "img/{$user->id}/" . $data['image']->getClientOriginalName();
            Storage::disk()->put($filename, $res);
            $user->update(['image' => $filename]);
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

    protected function validation_rules($new = true, $id = null) {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|unique:users|max:255',
            'role' => 'required',
            'phone' => 'nullable|digits_between:8,15',
            'image' => 'image',
        ];

        if (!$new) {
            $rules['username'] = "required|unique:users,username,{$id}|max:255";
            $rules['password'] = "nullable|min:6|confirmed";
            $rules['email'] = "required|unique:users,email,{$id}|max:255";
        }



        $messages = [
            //required fields
            'name.required' => 'يجب ادخال اسم المستخدم',
            'username.required' => 'يجب ادخال اسم المستخدم فى النظام',
            'password.required' => 'يجب ادخال كلمه السر',
            'email.required' => 'يجب ادخال البريد الالكترونى',
            'role.required' => 'يجب اختيار مجموعة الصلاحيات',
            //unique fields
            'username.unique' => 'تم استخدام اسم المستخدم فى النظام من قبل',
            'email.unique' => 'تم استخدام البريد الاكترونى من قبل',
            //max 255
            'name.required' => 'يجب ان لا يزيد اسم المستخدم عن 255 حرف',
            'username.required' => 'يجب ان لا يزيد اسم المستخدم فى النظام عن 255 حرف',
            'email.required' => 'يجب ان لا يزيد البريد الاكترونى عن 255 حرف',
            //custom
            'password.min' => 'يجب أن لا تقل كلمة السر عن 6 أحرف',
            'password.confirmed' => 'تأكيد كلمه السر غير صحيح',
            'phone.digits_between' => 'يجب ادخال رقم فى خانة رقم الهاتف',
            'image.image' => 'يجب اختيار ملف صوره للصوره الشخصية'
        ];

        return [$rules, $messages];
    }

}
