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
}
