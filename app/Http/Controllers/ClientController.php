<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $clients = \App\Client::all();
        return view('client', compact('clients'));
    }

    public function edit($id) {

        $msg = ['status' => 'nothing'];
        $client = \App\Client::find($id);

        if (!$client)
            return redirect()->action('ClientController@index')->with($msg);

        $objectives = \App\TaskObjective::all()->clientBy('category_id');

        return view('client_edit', compact('client', 'objectives'));
    }

    public function save(Request $request) {
        $id = $request->input('id');

        $msg = ['status' => 'nothing'];
        //$client = \App\Client::find($id);

        /*if ($id == 'null') {
            $client = \App\Client::create($request->all());
            $client->objectives()->sync($objs);
            $msg = ['status' => 'created'];
        } else if ($client) {
            $client->update($request->all());
            $client->objectives()->sync($objs);
            $msg = ['status' => 'updated'];
        }*/

        if ($msg['status'] == 'nothing')
            return redirect()->back()->with($msg)->withInput();
        else
            return redirect()->back()->with($msg);
    }

    public function delete($id) {

        $msg = ['status' => 'nothing'];

        if ($client = \App\Client::find($id)) {
            $client->objectives()->sync([]);
            $client->delete();
            $msg = ['status' => 'deleted'];
        }

        return redirect()->action('ClientController@index')->with($msg);
    }

}
