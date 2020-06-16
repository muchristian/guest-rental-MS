<?php

namespace App\Helper;

use JWTAuth;

trait jwtHelper {
    public function expDate($token) {
    $exp =  JWTAuth::setToken($token)->getPayload()->get('exp');
    return date('Y-m-d H:i:s', $exp);
    }
}