@extends('admin.layout')
@section('content')
    {{ Breadcrumbs::render('admin.brands.index') }}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thương hiệu sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <a class="btn btn-sm btn-success" href="{{ route('admin.brands.create') }}"><i class="fa fa-plus"></i> Thêm mới</a>                
                    <button class="btn btn-sm btn-danger" id="btn-delete-selected"><i class="fa fa-trash"></i> Xóa mục đã chọn</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <form action="{{ route('admin.brands.index') }}" method="get">
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
                            <th>Tên thương hiệu</th>
                            <th>Hiển thị</th>
                            <th>Mô tả</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr id="row-{{$brand->id}}">
                                <td><label class="i-checks m-b-none"><input type="checkbox" class="input-checkbox" name="ids[]" value="{{$brand->id}}"></label></td>
                                <td>{{$brand->name}}</td>
                                <td><span class="text-ellipsis">
                                    <a href="javascript:;" class="btn-status" id="{{$brand->id}}"><input type="checkbox"   @if($brand->status) checked @endif data-toggle="toggle" data-onstyle="success" data-size="sm"></a>
                                </td>
                                <td><span class="text-ellipsis">{{$brand->description}}</span></td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand->url) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success"></i></a>
                                    <a href="javascript:;" id="{{$brand->id}}" class="active btn-delete" ui-toggle-class=""><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.components.footer-table', ['data'=>$brands])
        </div>
    </div>
    <script src="{{asset('admin/ajax/brand.js')}}"></script>
@endsection