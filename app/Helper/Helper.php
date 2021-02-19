<?php
namespace App\Helper;
use Illuminate\Support\Str;


class Helper {

    public static function randomString($numberCharacter) {
        return Str::random($numberCharacter);
    }

    public static function createUrl($name) {
        $str = Str::of($name)->slug('-')."-".Helper::randomString(12);
        return $str;
    }
    
}
