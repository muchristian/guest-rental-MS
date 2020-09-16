<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestHouse extends Model
{
    protected $fillable = [
        'name', 'slogan', 'logo', 'location', 'status'
    ];


    public function users() {
        return $this->hasMany('App\User', 'guest_house_fk');
    }
    public function rooms() {
        return $this->hasMany('App\Room', 'guest_house_fk');
    }

    public function guests() {
        return $this->hasMany('App\Guest', 'guest_house_fk');
    }

    public function services() {
        return $this->hasMany('App\Service', 'guest_house_fk');
    }
}
