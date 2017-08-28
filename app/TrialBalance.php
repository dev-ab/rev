<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrialBalance extends Model {

    protected $fillable = ['client_id', 'work_point_id', 'name', 'initial_debit', 'initial_credit', 'move_debit', 'move_credit'];
    protected $attributes = [
        'client_id' => 0,
        'work_point_id' => 0,
        'name' => '',
        'initial_debit' => 0,
        'initial_credit' => 0,
        'move_debit' => 0,
        'move_credit' => 0];

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function workPoint() {
        return $this->belongsTo('App\WorkPoint');
    }

}
