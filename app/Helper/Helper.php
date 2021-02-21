<?php
namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Helper {

    public static function randomString($numberCharacter) {
        return Str::random($numberCharacter);
    }

    public static function createUrl($name) {
        $str = Str::of($name)->slug('-')."-".Helper::randomString(12);
        return $str;
    }
    public static function createMessage($res, $type) {
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
            case Constants::TYPE_NOT_FOUND:
                $res['message'] = Message::MESSAGE_NOT_FOUND;
            default:
                 $res['message'] = Message::MESSAGE_SUCCESS;
        }
        return $res;
    }
    public static function createResponseSuccess($type) {
        $res = Constants::RESPONSE_NOTIFICATION_SUCCESS;
        $res = Helper::createMessage($res, $type);
        return $res;
    }

    public static function createResponseFail($type) {
        $res = Constants::RESPONSE_NOTIFICATION_FAIL;
        $res = Helper::createMessage($res, $type);
        return $res;
    }

    public static function createFlashSuccess(Request $request, $type) {
        $res = Constants::RESPONSE_NOTIFICATION_SUCCESS;
        $res = Helper::createMessage($res, $type);
        $request->session()->flash('alert-success', $res);
    }

    public static function createFlashFail(Request $request, $type) {
        $res = Constants::RESPONSE_NOTIFICATION_FAIL;
        $res = Helper::createMessage($res, $type);
        $request->session()->flash('alert-danger', $res);
    }
    
}
