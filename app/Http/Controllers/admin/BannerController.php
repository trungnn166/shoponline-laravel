<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Helper\Message;
use App\Http\Controllers\Controller;
use App\Service\Impl\BannerServiceImpl;
use Illuminate\Http\Request;

class BannerController extends Controller {

    private $bannerService;
    public function __construct(BannerServiceImpl $bannerService) {
		$this->bannerService = $bannerService;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $params = $request->all();
        $banners = $this->bannerService->getData($params);
        return view('admin.banners.index', 
                    ['title' => 'Danh sách banner', 'params'=>$params, 'banners'=>$banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.banners.create', ['title' => 'Thêm mới banner']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        if($request->hasFile('image')) { 
            $data['image'] = Helper::uploadFile($request->image, Constants::PATH_UPLOAD_IMAGE_PRODUCT);
        }
        $result = $this->bannerService->create($data);
        ($result != null) ? Helper::createFlashSuccess($request, Constants::TYPE_CREATE) : Helper::createFlashFail($request, Constants::TYPE_CREATE);
        return redirect()->route('admin.banners.create'); 
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
        $banner = $this->bannerService->findByUrl($url);
        if($banner == null) {
            $request->session()->flash('alert-success', ['icon' => 'fa fa-exclamation-circle', 'message' => Message::MESSAGE_NOT_FOUND.' danh mục này.']);
            Helper::createFlashSuccess($request, Constants::TYPE_NOT_FOUND);
            return redirect()->route('admin.banners.index'); 
        }
        return view('admin.banners.edit', ['title' => 'Chỉnh sửa banner', 'banner' => $banner]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $data = $request->all();
        if($request->hasFile('image')) { 
            $data['image'] = Helper::uploadFile($request->image, Constants::PATH_UPLOAD_IMAGE_PRODUCT);
        }
        $result = $this->bannerService->update($data);
        if(!empty($result)) {
            Helper::createFlashSuccess($request, Constants::TYPE_UPDATE);
            $url = $result;
        } else {
            Helper::createFlashFail($request, Constants::TYPE_UPDATE);
            $url = $request['url'];
        } 
        return redirect()->route('admin.banners.edit', ['url' => $url]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->bannerService->destroy($request->ids);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_DELETE) : Helper::createResponseFail(Constants::TYPE_DELETE);
        return response()->json($res, 201); 
    }

    public function changeStatus($id) {
        if(!is_numeric($id)) {
            $res = Helper::createResponseFail(Constants::TYPE_UPDATE);
            return response()->json($res, 201); 
        }
        $result = $this->bannerService->changeStatus($id);
        $res = ($result) ? Helper::createResponseSuccess(Constants::TYPE_UPDATE) : Helper::createResponseFail(Constants::TYPE_UPDATE);
        return response()->json($res, 201); 
    }
}
