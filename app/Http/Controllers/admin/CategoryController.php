<?php

namespace App\Http\Controllers\admin;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Helper\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Service\Impl\CategoryServiceImpl;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    private $categoryService;

    public function __construct(CategoryServiceImpl $categoryService) {
		$this->categoryService = $categoryService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $params = $request->all();
        $categories = $this->categoryService->getData($params);
        return view('admin.categories.index', 
                    ['title' => 'Danh sách danh mục', 'categories' => $categories, 'params'=>$params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.categories.create', ['title' => 'Thêm mới danh mục']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        $result = $this->categoryService->create($request->all());
        ($result) ? Helper::createFlashSuccess($request, Constants::TYPE_CREATE) : Helper::createFlashFail($request, Constants::TYPE_CREATE);
        return redirect()->route('admin.categories.create'); 
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
        $category = $this->categoryService->findByUrl($url);
        if($category == null) {
            $request->session()->flash('alert-success', ['icon' => 'fa fa-exclamation-circle', 'message' => Message::MESSAGE_NOT_FOUND.' danh mục này.']);
            Helper::createFlashSuccess($request, Constants::TYPE_NOT_FOUND);
            return redirect()->route('admin.categories.index'); 
        }
        return view('admin.categories.edit', ['title' => 'Chỉnh sửa danh mục', 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request) {
        $result = $this->categoryService->update($request->all());
        if(!empty($result)) {
            Helper::createFlashSuccess($request, Constants::TYPE_UPDATE);
            $url = $result;
        } else {
            Helper::createFlashFail($request, Constants::TYPE_UPDATE);
            $url = $request['url'];
        } 
        return redirect()->route('admin.categories.edit', ['url' => $url]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        //
        $result = $this->categoryService->destroy($request->ids);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_DELETE) : Helper::createResponseFail(Constants::TYPE_DELETE);
        return response()->json($res, 201); 
    }

    public function changeStatus($id) {
        if(!is_numeric($id)) {
            $res = Helper::createResponseFail(Constants::TYPE_UPDATE);
            return response()->json($res, 201); 
        }
        $result = $this->categoryService->changeStatus($id);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_UPDATE) : Helper::createResponseFail(Constants::TYPE_UPDATE);
        return response()->json($res, 201); 
    }

}
