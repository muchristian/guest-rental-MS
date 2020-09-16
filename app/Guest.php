<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'arrival_time',
        'departure_time',
        'status',
        'room_fk',
        'nationality',
        'id_type',
        'id_number',
        'extra_note',
        'guest_house_fk',
        'inserted_by', 
        'updated_by'
        
    ];

    public function guest_houses() {
        return $this->belongsTo('App\GuestHouse', 'guest_house_fk');
    }

    public function rooms() {
        return $this->belongsTo('App\Room', 'room_fk');
    }
    public function inserties_by() {
        return $this->belongsTo('App\User', 'inserted_by');
    }

    public function updaties_by() {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function services() {
        return $this->belongsToMany('App\Service', 'guest_services', 'guest_fk', 'service_fk');
    }
}
