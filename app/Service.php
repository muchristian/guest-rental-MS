<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name', 'service_price', 'remarks', 'guest_house_fk', 'inserted_by', 'updated_by'
    ];

    public function guest_houses() {
        return $this->belongsTo('App\GuestHouse', 'guest_house_fk');
    }

    public function inserties_by() {
        return $this->belongsTo('App\User', 'inserted_by');
    }

    public function updaties_by() {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function guests() {
        return $this->belongsToMany('App\Guest', 'guest_services', 'service_fk', 'guest_fk');
    }
}
