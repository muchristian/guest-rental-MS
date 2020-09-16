<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestService extends Model
{
    protected $table = 'guest_services';
    
    protected $fillable = [
        'guest_fk', 'service_fk', 'inserted_by', 'updated_by'
    ];

    public function inserties_by() {
        return $this->belongsTo('App\User', 'inserted_by');
    }

    public function updaties_by() {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function guests() {
        return $this->belongsTo('App\Guest', 'guest_fk');
    }

    public function services() {
        return $this->belongsTo('App\Service', 'service_fk');
    }

}
