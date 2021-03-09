<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\ProductImage;
use App\Service\ProductImageService;

class ProductImageServiceImpl implements ProductImageService {
    public function create($files) {
        $fileName = date('y-m-d-h_h-i-s').'_'.$files[0]->getClientOriginalName();
        $files[0]->move(public_path(Constants::PATH_UPLOAD_IMAGE_PRODUCT), $fileName);
        $productImage = new ProductImage();
        $productImage->image_url= Constants::PATH_UPLOAD_IMAGE_PRODUCT.$fileName;
        $productImage->image_name = $fileName;
        $productImage->save();
        return $productImage->id;
    }

    public function destroy($id) {
        return ProductImage::destroy($id);
    }

    public function updateProductId($imageIdsStr, $productId) {
        if(!empty($imageIdsStr)) {
            $imageIds = explode(',', $imageIdsStr);
            ProductImage::whereIn('id', $imageIds)->update(['product_id' => $productId]);
        }
    }

    public function update($id) {

    }

    public function getData($params) {
        
    }

    public function changeStatus($id) {

    }

    public function findByUrl($url) {

    }

    public function getByStatus($status) {

    }
}