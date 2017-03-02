<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $fillable = ['name'];

    public function objectives() {
        return $this->belongsToMany('App\TaskObjective', 'group_objective', 'group_id', 'objective_id');
    }

}
