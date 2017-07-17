<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {

    protected $fillable = ['name', 'description', 'path', 'ref', 'type', 'sizeKB'];
    protected $attributes = [
        'description' => '',
        'ref' => '',
        'type' => '',
        'sizeKB' => ''
    ];

    public function owner() {
        return $this->morphTo();
    }

}
