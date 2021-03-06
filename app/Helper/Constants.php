<?php
namespace App\Helper;

class Constants {
    const TYPE_CREATE = 1;
    const TYPE_UPDATE = 2;
    const TYPE_DELETE = 3;
    const TYPE_NOT_FOUND = 4;
    
    const PAGE_SIZE = 20;
    const RESPONSE_NOTIFICATION_SUCCESS = [
        'class' => 'alert-success',
        'icon' => 'fa fa-check-circle',
        'status' => 200
    ];

    const RESPONSE_NOTIFICATION_FAIL =  [
        'class' => 'alert-danger',
        'icon' => 'fa fa-exclamation-circle',
        'status' => 500
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 2;

    const PATH_UPLOAD_IMAGE_PRODUCT = '/upload/images/products/';
}