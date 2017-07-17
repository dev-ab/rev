<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    protected $fillable = ['type', 'data', 'default'];
    protected $attributes = ['default' => 0];

    public function owner() {
        return $this->morphTo();
    }

}
