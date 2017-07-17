<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model {

    protected $fillable = ['client_id', 'name', 'percentage', 'phone', 'fax', 'email'];

}
