<?php

namespace App\Http\Controllers\admin;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Helper\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Service\Impl\BrandServiceImpl;
use Illuminate\Http\Request;

class BrandController extends Controller {

    private $brandService;

    public function __construct(BrandServiceImpl $brandService) {
		$this->brandService = $brandService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $params = $request->all();
        $brands = $this->brandService->getData($params);
        return view('admin.brands.index', 
                    ['title' => 'Danh sách thương hiệu', 'brands' => $brands, 'params'=>$params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.brands.create', ['title' => 'Thêm mới thương hiệu']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request) {
        $result = $this->brandService->create($request->all());
        ($result) ? Helper::createFlashSuccess($request, Constants::TYPE_CREATE) : Helper::createFlashFail($request, Constants::TYPE_CREATE);
        return redirect()->route('admin.brands.create'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $url = null) {
        $brand = $this->brandService->findByUrl($url);
        if($brand == null) {
            $request->session()->flash('alert-success', ['icon' => 'fa fa-exclamation-circle', 'message' => Message::MESSAGE_NOT_FOUND.' danh mục này.']);
            Helper::createFlashSuccess($request, Constants::TYPE_NOT_FOUND);
            return redirect()->route('admin.categories.index'); 
        }
        return view('admin.brands.edit', ['title' => 'Chỉnh sửa danh mục', 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request) {
        $result = $this->brandService->update($request->all());
        if(!empty($result)) {
            Helper::createFlashSuccess($request, Constants::TYPE_UPDATE);
            $url = $result;
        } else {
            Helper::createFlashFail($request, Constants::TYPE_UPDATE);
            $url = $request['url'];
        } 
        return redirect()->route('admin.brands.edit', ['url' => $url]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        //
        $result = $this->brandService->destroy($request->ids);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_DELETE) : Helper::createResponseFail(Constants::TYPE_DELETE);
        return response()->json($res, 201); 
    }

    public function changeStatus($id) {
        if(!is_numeric($id)) {
            $res = Helper::createResponseFail(Constants::TYPE_UPDATE);
            return response()->json($res, 201); 
        }
        $result = $this->brandService->changeStatus($id);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_UPDATE) : Helper::createResponseFail(Constants::TYPE_UPDATE);
        return response()->json($res, 201); 
    }

}
