<?php
namespace App\Service\Impl;

use App\Helper\Helper;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryServiceImpl implements CategoryService {

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        $result = Category::create($data);
        return $result;
    }

    public function delete($id) {

    }

    public function getData() {
        $data = Category::all();
        return $data;
    }
    
    public function changeStatus($id) {
        try {
            $category = Category::findOrFail($id);
            $category->status = !($category->status);
            return $category->save();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}