<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $fillable = ['name', 'description'];
    protected $attributes = ['description' => ''];

    public function objs() {
        return $this->belongsToMany('App\ProgramObjective', 'group_objective', 'group_id', 'objective_id');
    }

}
