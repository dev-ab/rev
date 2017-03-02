<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskObjective extends Model {

    protected $fillable = ['category_id', 'name', 'description', 'constant'];
    protected $attributes = ['constant' => 0];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function groups() {
        return $this->belongsToMany('App\Group', 'group_objective', 'objective_id', 'group_id');
    }

}
