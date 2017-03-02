<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $cats = \App\Category::all();

        return view('cat', compact('cats'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $cat = \App\Category::find($id);

        if (!$cat)
            return redirect()->action('CategoryController@index')->with($msg);

        return view('cat_edit', compact('cat'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        $cat = \App\Category::find($id);

        if ($id == 'null') {
            $cat = \App\Category::create($request->all());
            $msg = ['status' => 'created'];
        } else if ($cat) {
            $cat->update($request->all());
            $msg = ['status' => 'updated'];
        }

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];
        $cat = \App\Category::find($id);

        if ($cat) {
            $cat->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('CategoryController@index')->with($msg);
    }

}
