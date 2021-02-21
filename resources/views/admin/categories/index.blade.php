@extends('admin.layout')
@section('content')
    {{ Breadcrumbs::render('admin.categories.index') }}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                <button class="btn btn-sm btn-danger" id="btn-delete-selected"><i class="fa fa-trash"></i> Xóa mục đã chọn</button>                
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
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
                            <th>Tên danh mục</th>
                            <th>Hiển thị</th>
                            <th>Mô tả</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr id="row-{{$category->id}}">
                                <td><label class="i-checks m-b-none"><input type="checkbox" class="input-checkbox" name="ids[]" value="{{$category->id}}"></label></td>
                                <td>{{$category->name}}</td>
                                <td><span class="text-ellipsis">
                                    <a href="javascript:;" class="btn-status" id="{{$category->id}}"><input type="checkbox"   @if($category->status) checked @endif data-toggle="toggle" data-onstyle="success" data-size="sm"></a>
                                </td>
                                <td><span class="text-ellipsis">{{$category->description}}</span></td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->url) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil text-success"></i></a>
                                    <a href="javascript:;" id="{{$category->id}}" class="active btn-delete" ui-toggle-class=""><i class="fa fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('admin/ajax/category.js')}}"></script>
@endsection