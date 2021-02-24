<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\Brand;
use App\Service\BrandService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandServiceImpl implements BrandService {

    public function getData($params) {
        $name = isset($params['name']) ? $params['name'] : '';
        $data = Brand::where('name', 'LIKE',  '%'.$name.'%')->paginate(Constants::PAGE_SIZE);
        $data->appends($params);
        return $data;
    }

    public function findByUrl($url) {
        try {
            return Brand::where('url', $url)->firstOrFail(); 
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        return Brand::create($data);
    }

    public function update($data) {
        $data['url'] = Helper::createUrl($data['name']);
        try {
            $brand = Brand::findOrFail($data['id']);
            $result =  $brand->update($data);
            return (($result) ? $data['url'] : false);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function destroy($ids) {
        $result = Brand::destroy($ids);
        return $result;
    }
    
    public function changeStatus($id) {
        try {
            $brand = Brand::findOrFail($id);
            $brand->status = !($brand->status);
            return $brand->save();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function getDataActive() {
        $data = Brand::where('status', 1)->get();
        return $data;
    }
}