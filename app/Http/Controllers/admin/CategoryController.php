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
    public function index() {
        $categories = $this->categoryService->getData();
        return view('admin.categories.index', 
                    ['title' => 'Danh sách danh mục', 'categories' => $categories]);
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
        $request->session()->flash('alert-success', ['icon' => 'fa fa-check-circle', 'message' => Message::MESSAGE_CREATE_SUCCESS]);
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
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function changeStatus(Request $request) {
        if(!is_numeric($request->id)) {
            $res = Helper::createResponseFail(Constants::TYPE_UPDATE);
            return response()->json($res, 201); 
        }
        $result = $this->categoryService->changeStatus($request->id);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_UPDATE) : Helper::createResponseFail(Constants::TYPE_UPDATE);
        return response()->json($res, 201); 
    }

}
