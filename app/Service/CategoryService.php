<?php
namespace App\Service;

interface CategoryService extends BaseService {
    public function getListParent($status);
}