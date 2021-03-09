<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductServiceImpl implements ProductService {
    private $productImageService;
    public function __construct(ProductImageServiceImpl $productImageService) {
		$this->productImageService = $productImageService;
	}    

    public function getData($params) {
        $name = isset($params['name']) ? $params['name'] : '';
        $data = Product::where('name', 'LIKE',  '%'.$name.'%')->paginate(Constants::PAGE_SIZE);
        $data->appends($params);
        return $data;
    }

    public function findByUrl($url) {
        try {
            return Product::where('url', $url)->firstOrFail(); 
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        $tagsStr = implode(",", $data['tags']);
        $data['tags'] = $tagsStr;
        $data['tags_slug'] = Helper::slugTag($tagsStr);
        $product = new Product($data);
        $product->save();
        $this->productImageService->updateProductId($data['image_ids'], $product->id);
        return $product;
    }

    public function update($data) {
        $data['url'] = Helper::createUrl($data['name']);
        $tagsStr = implode(",", $data['tags']);
        $data['tags'] = $tagsStr;
        $data['tags_slug'] = Helper::slugTag($tagsStr);
        try {
            $product = Product::findOrFail($data['id']);
            $result =  $product->update($data);
            return (($result) ? $data['url'] : false);
        } catch (ModelNotFoundException $e) {
            return false;
        }
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

    public function getByStatus($status = '') {
        
    }
    
}