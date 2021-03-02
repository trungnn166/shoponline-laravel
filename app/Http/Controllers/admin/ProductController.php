<?php

namespace App\Http\Controllers\admin;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Helper\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
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
        $categoryParents = $this->categoryService->getListParent();
        $brands = $this->brandService->getByStatus();
        return view('admin.products.create', 
                    ['title' => 'Thêm mới sản phẩm', 'categoryParents' => $categoryParents, 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) {
        $data = $request->all();
        if($request->hasFile('image')) { 
            $data['image'] = Helper::uploadFile($request->image, Constants::PATH_UPLOAD_IMAGE_PRODUCT);
        }
        $result = $this->productService->create($data);
        ($result) ? Helper::createFlashSuccess($request, Constants::TYPE_CREATE) : Helper::createFlashFail($request, Constants::TYPE_CREATE);
        return redirect()->route('admin.products.create'); 
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $url = null) {
        $product = $this->productService->findByUrl($url);
        $categoryParents = $this->categoryService->getListParent();
        $brands = $this->brandService->getByStatus();
        if($product == null) {
            $request->session()->flash('alert-success', ['icon' => 'fa fa-exclamation-circle', 'message' => Message::MESSAGE_NOT_FOUND.' sản phẩm này.']);
            Helper::createFlashSuccess($request, Constants::TYPE_NOT_FOUND);
            return redirect()->route('admin.products.index'); 
        }
        return view('admin.products.edit', ['title' => 'Chỉnh sửa sản phẩm', 'product' => $product, 'categoryParents' => $categoryParents, 'brands' => $brands]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request) {
        $data = $request->all();
        if($request->hasFile('image')) { 
            $data['image'] = Helper::uploadFile($request->image, Constants::PATH_UPLOAD_IMAGE_PRODUCT);
        }
        $result = $this->productService->update($data);
        if(!empty($result)) {
            Helper::createFlashSuccess($request, Constants::TYPE_UPDATE);
            $url = $result;
        } else {
            Helper::createFlashFail($request, Constants::TYPE_UPDATE);
            $url = $request['url'];
        } 
        return redirect()->route('admin.products.edit', ['url' => $url]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        //
        $result = $this->productService->destroy($request->ids);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_DELETE) : Helper::createResponseFail(Constants::TYPE_DELETE);
        return response()->json($res, 201); 
    }

    public function changeStatus($id) {
        if(!is_numeric($id)) {
            $res = Helper::createResponseFail(Constants::TYPE_UPDATE);
            return response()->json($res, 201); 
        }
        $result = $this->productService->changeStatus($id);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_UPDATE) : Helper::createResponseFail(Constants::TYPE_UPDATE);
        return response()->json($res, 201); 
    }

}
