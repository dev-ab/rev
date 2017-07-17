<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditor extends Model {

    protected $fillable = ['client_id', 'name', 'job', 'phone', 'fax', 'email'];

}
