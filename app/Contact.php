<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    public function owner() {
        return $this->morphTo();
    }

}
