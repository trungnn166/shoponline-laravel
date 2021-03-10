@extends('admin.layout')
@section('content')
    {{ Breadcrumbs::render('admin.banners.index') }}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$title}}
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <a class="btn btn-sm btn-success" href="{{ route('admin.banners.create') }}"><i class="fa fa-plus"></i> Thêm mới</a>                
                    <button class="btn btn-sm btn-danger" id="btn-delete-selected"><i class="fa fa-trash"></i> Xóa mục đã chọn</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <form action="{{ route('admin.banners.index') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Nhập tên muốn tìm kiếm" name="name" @isset($params['name']) value="{{$params['name']}}" @endisset/>
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                @include('admin.components.message-ajax')

                <table class="table table-striped b-t b-light" id="tbl">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox" id="check-all">
                                </label>
                            </th>
                            <th>Tên banner</th>
                            <th>Hình ảnh</th>
                            <th>Hiển thị</th>
                            <th>Mô tả</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr id="row-{{$banner->id}}">
                                <td><label class="i-checks m-b-none"><input type="checkbox" class="input-checkbox" name="ids[]" value="{{$banner->id}}"></label></td>
                                <td>{{$banner->name}}</td>
                                <td class="text-center"><img src="{{$banner->image}}"></td>
                                <td><span class="text-ellipsis">
                                    <a href="javascript:;" class="btn-status" id="{{$banner->id}}"><input type="checkbox"   @if($banner->status) checked @endif data-toggle="toggle" data-onstyle="success" data-size="sm"></a>
                                </td>
                                <td><span class="text-ellipsis">{{$banner->description}}</span></td>
                                <td>
                                    <a href="{{ route('admin.banners.edit', $banner->url) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success"></i></a>
                                    <a href="javascript:;" id="{{$banner->id}}" class="active btn-delete" ui-toggle-class=""><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.components.footer-table', ['data'=>$banners])
        </div>
    </div>
    <script src="{{asset('admin/ajax/banner.js')}}"></script>
@endsection