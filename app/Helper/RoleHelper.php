<?php

namespace App\Helper;

class RoleHelper {
    public static function Roles($role) {
        if ($role === 'SUPER_ADMIN') {
            return array('MANAGER', 'ADMIN', 'SUPER_ADMIN');
        }
        else {
            return array('MANAGER', 'ADMIN');
        }
    }
}
