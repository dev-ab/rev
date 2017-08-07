<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramObjective extends Model {

    protected $fillable = ['program_id', 'description'];

    public function program() {
        return $this->belongsTo('App\Program');
    }

}
