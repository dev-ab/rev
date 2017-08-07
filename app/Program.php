<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {

    protected $fillable = ['name', 'title'];
    protected $attributes = ['title' => ''];

    public function objs() {
        return $this->hasMany('App\ProgramObjective');
    }

}
