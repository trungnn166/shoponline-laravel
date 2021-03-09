<?php

namespace App\Service;

interface ProductImageService extends BaseService {
    public function updateProductId($imageIds, $productId);
}