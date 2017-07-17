<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $fillable = [
        'company_name',
        'company_activity',
        'company_address',
        'company_register_number',
        'company_register_expiration',
        'company_apparent_capital',
        'company_money_capital',
        'company_total_capital',
        'company_type',
        'company_zakkat',
        'manager_id'
    ];
    protected $attributes = ['manager_id' => 0];

    public function attachments() {
        return $this->morphMany('App\Attachment', 'owner');
    }

    public function contacts() {
        return $this->morphMany('App\Contact', 'owner');
    }

    public function partners() {
        return $this->hasMany('App\Partner');
    }

    public function reps() {
        return $this->hasMany('App\Representative');
    }

    public function auditors() {
        return $this->hasMany('App\Auditor');
    }

}
