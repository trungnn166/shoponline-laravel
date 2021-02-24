<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\Impl\BrandServiceImpl;
use App\Service\Impl\CategoryServiceImpl;
use App\Service\Impl\ProductServiceImpl;
use Illuminate\Http\Request;

class ProductController extends Controller {
    //
    private $productService;
    private $categoryService;
    private $brandService;

    public function __construct(ProductServiceImpl $productService, CategoryServiceImpl $categoryService, BrandServiceImpl $brandService) {
		$this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $params = $request->all();
        $products = $this->productService->getData($params);
        return view('admin.products.index', 
                    ['title' => 'Danh sách sản phẩm', 'products' => $products, 'params'=>$params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = $this->categoryService->getDataActive();
        $brands = $this->brandService->getDataActive();
        return view('admin.products.create', 
                    ['title' => 'Thêm mới sản phẩm', 'categories' => $categories, 'brands' => $brands]);
    }

}
