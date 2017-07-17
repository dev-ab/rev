<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model {

    protected $fillable = ['client_id', 'name', 'job', 'phone', 'fax', 'email'];

}
