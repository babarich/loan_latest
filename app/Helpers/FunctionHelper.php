<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class  FunctionHelper{
   public static function createCode($last_code = 12345) {
        $number_part = substr($last_code, -3);
        return strtoupper(substr((Auth::user()->first_name), 0, 2)) . '-' . ((int) $number_part + 1);
    }
}