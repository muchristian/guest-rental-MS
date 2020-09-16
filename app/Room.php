<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name', 'room_type', 'status', 'comment', 'guest_house_fk', 'inserted_by', 'updated_by'
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
        if ($this->room_type === 'single' && $this->status === 'active') {
            return $this->hasOne('App\Guest', 'room_fk');
        } else {
            return $this->hasMany('App\Guest', 'room_fk');
        }
    }
}
