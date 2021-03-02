@extends('admin.layout')
@section('content')
    {{ Breadcrumbs::render('admin.brands.index') }}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$title}}
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <a class="btn btn-sm btn-success" href="{{ route('admin.products.create') }}"><i class="fa fa-plus"></i> Thêm mới</a>                
                    <button class="btn btn-sm btn-danger" id="btn-delete-selected"><i class="fa fa-trash"></i> Xóa mục đã chọn</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <form action="{{ route('admin.products.index') }}" method="get">
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

                <table class="table table-striped b-t b-light" id="tbl" >
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox" id="check-all">
                                </label>
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Tên danh mục</th>
                            <th>Tên thương hiệu</th>
                            <th>Giá</th>
                            <th class="text-center">Hình ảnh</th>
                            <th>Thẻ</th>
                            <th>Hiển thị</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr id="row-{{$product->id}}">
                                <td><label class="i-checks m-b-none"><input type="checkbox" class="input-checkbox" name="ids[]" value="{{$product->id}}"></label></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->brand->name}}</td>
                                <td><span class="money">{{number_format($product->price)}}</span> VNĐ</td>
                                <td class="text-center"><img src="{{$product->image}}"></td>
                                <td>
                                    @if ($product->tags != "")
                                        @foreach(explode(',', $product->tags) as $tag) 
                                            <span class="badge badge-success">{{$tag}}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td><span class="text-ellipsis">
                                    <a href="javascript:;" class="btn-status" id="{{$product->id}}"><input type="checkbox"   @if($product->status) checked @endif data-toggle="toggle" data-onstyle="success" data-size="sm"></a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product->url) }}" class="active" ui-toggle-class="" title="Sửa"><i class="fa fa-pencil text-success"></i></a>
                                    <a href="javascript:;" id="{{$product->id}}" class="active btn-delete" ui-toggle-class="" title="Xóa"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @include('admin.components.footer-table', ['data'=>$products])
        </div>
    </div>
    <script src="{{asset('admin/ajax/product.js')}}"></script>
@endsection