<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryServiceImpl implements CategoryService {

    public function getData($params) {
        $name = isset($params['name']) ? $params['name'] : '';
        $data = Category::where('name', 'LIKE',  '%'.$name.'%')->paginate(Constants::PAGE_SIZE);
        $data->appends($params);
        return $data;
    }

    public function findByUrl($url) {
        try {
            return Category::where('url', $url)->firstOrFail(); 
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        return Category::create($data);
    }

    public function update($data) {
        $data['url'] = Helper::createUrl($data['name']);
        try {
            $category = Category::findOrFail($data['id']);
            $result =  $category->update($data);
            return (($result) ? $data['url'] : false);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function destroy($ids) {
        $result = Category::destroy($ids);
        return $result;
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