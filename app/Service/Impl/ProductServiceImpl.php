<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\Brand;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductServiceImpl implements ProductService {

    public function getData($params) {
        // $name = isset($params['name']) ? $params['name'] : '';
        // $data = Brand::where('name', 'LIKE',  '%'.$name.'%')->paginate(Constants::PAGE_SIZE);
        // $data->appends($params);
        // return $data;
    }

    public function findByUrl($url) {
        try {
            return Product::where('url', $url)->firstOrFail(); 
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data) {
        // $data['url'] = Helper::createUrl($data['name']);
        // return Brand::create($data);
    }

    public function update($data) {
        // $data['url'] = Helper::createUrl($data['name']);
        // try {
        //     $brand = Brand::findOrFail($data['id']);
        //     $result =  $brand->update($data);
        //     return (($result) ? $data['url'] : false);
        // } catch (ModelNotFoundException $e) {
        //     return false;
        // }
    }

    public function destroy($ids) {
        $result = Product::destroy($ids);
        return $result;
    }
    
    public function changeStatus($id) {
        try {
            $product = Product::findOrFail($id);
            $product->status = !($product->status);
            return $product->save();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function getDataActive() {
        
    }
}