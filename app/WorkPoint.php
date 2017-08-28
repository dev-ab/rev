<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkPoint extends Model {

    protected $fillable = ['number', 'name', 'parent_id', 'level', 'initial'];
    protected $attributes = ['parent_id' => 0, 'level' => 4, 'initial' => 0];

    public function children() {
        return $this->hasMany('App\WorkPoint', 'parent_id');
    }

    public function theParent() {
        return $this->belongsTo('App\WorkPoint', 'parent_id');
    }

    public function trialBalance() {
        return $this->hasMany('App\TrialBalance', 'work_point_id');
    }

}
