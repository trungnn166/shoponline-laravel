<?php
namespace App\Service\Impl;

use App\Helper\Helper;
use App\Models\Category;
use App\Service\CategoryService;

class CategoryServiceImpl implements CategoryService {

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        $result = Category::create($data);
        return $result;
    }

    public function delete($id) {

    }
    
}