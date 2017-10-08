<?php
namespace App\Custom;

use Illuminate\Support\Facades\Auth;

class CustomAuth extends Auth
{
    public static function hasRole($role)
    {
    	if(self::check()){
    		return self::user()->role == $role;
    	}else{
    		return false;
    	}
    }
}