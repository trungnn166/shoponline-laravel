<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\Impl\ProductImageServiceImpl;
use Illuminate\Http\Request;

class ProductImageController extends Controller {
    private $productImageService;
    public function __construct(ProductImageServiceImpl $productImageService) {
		$this->productImageService = $productImageService;
	}
    public function store(Request $request) {
        $id = $this->productImageService->create($request->file);
        return response()->json(['id'=>$id]);
    }
    
    public function update() {

    }

    public function destroy(Request $request) {
        $result = $this->productImageService->destroy($request->id);
        return response()->json(['result'=>$result]);
    }
}
