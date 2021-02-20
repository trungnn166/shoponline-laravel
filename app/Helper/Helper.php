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

    public static function createResponseSuccess($type) {
        $res = Constants::RESPONSE_NOTIFICATION_SUCCESS;
        switch($type) {
            case Constants::TYPE_CREATE:
                $res['message'] = Message::MESSAGE_CREATE_SUCCESS;
                break;
            case Constants::TYPE_UPDATE:
                $res['message'] = Message::MESSAGE_UPDATE_SUCCESS;
                break;
            case Constants::TYPE_DELETE:
                $res['message'] = Message::MESSAGE_DELETE_SUCCESS;
                break;
            default:
                 $res['message'] = Message::MESSAGE_SUCCESS;
        }
        return $res;
    }

    public static function createResponseFail($type) {
        $res = Constants::RESPONSE_NOTIFICATION_FAIL;
        switch($type) {
            case Constants::TYPE_CREATE:
                $res['message'] = Message::MESSAGE_CREATE_FAIL;
                break;
            case Constants::TYPE_UPDATE:
                $res['message'] = Message::MESSAGE_UPDATE_FAIL;
                break;
            case Constants::TYPE_DELETE:
                $res['message'] = Message::MESSAGE_DELETE_FAIL;
                break;
            default:
                 $res['message'] = Message::MESSAGE_FAIL;
        }
        return $res;
    }
    
}
