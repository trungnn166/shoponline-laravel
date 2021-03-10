<?php
namespace App\Service\Impl;

use App\Helper\Constants;
use App\Helper\Helper;
use App\Models\Banner;
use App\Service\BannerService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BannerServiceImpl implements BannerService {

    public function getData($params) {
        $name = isset($params['name']) ? $params['name'] : '';
        $data = Banner::where('name', 'LIKE',  '%'.$name.'%')->paginate(Constants::PAGE_SIZE);
        $data->appends($params);
        return $data;
    }

    public function findByUrl($url) {
        try {
            return Banner::where('url', $url)->firstOrFail(); 
        } catch(ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data) {
        $data['url'] = Helper::createUrl($data['name']);
        return Banner::create($data);
    }

    public function update($data) {
        $data['url'] = Helper::createUrl($data['name']);
        try {
            $brand = Banner::findOrFail($data['id']);
            $result =  $brand->update($data);
            return (($result) ? $data['url'] : false);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function destroy($ids) {
        $result = Banner::destroy($ids);
        return $result;
    }
    
    public function changeStatus($id) {
        try {
            $banner = Banner::findOrFail($id);
            $banner->status = !($banner->status);
            return $banner->save();
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function getByStatus($status = '') {
        if($status == '') {
            $data = Banner::all();
        } else {
            $data = Banner::where('status', $status)->get();
        }
        return $data;
    }
}