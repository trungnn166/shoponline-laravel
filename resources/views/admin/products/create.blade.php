@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Breadcrumbs::render('admin.products.create') }}
        <section class="panel">
            <header class="panel-heading">
                {{$title}}
            </header>
            @include('admin.components.message')
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm">
                            <p class="help text-error">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img  class="img-thumbnail full-width mb-5px" id="image-preview" src="{{asset('images/default-image.png')}}" >
                            <input type="file" class="form-control" name="image" id="input-image">
                            <p class="help text-error">{{ $errors->first('image') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Danh mục <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <select class="selectpicker form-control" data-live-search="true" name="category_id">
                                    @foreach ($categoryParents as $parent)
                                        <optgroup label="{{$parent->name}}">
                                            @if($parent->childrens->count() > 0)
                                                @foreach ($parent->childrens as $children)
                                                    <option value="{{$children->id}}">{{$children->name}}</option>
                                                @endforeach                                                
                                            @else
                                                <option value="{{$parent->id}}">{{$parent->name}}</option>
                                            @endif
                                        </optgroup>
                                    @endforeach
                                </select>
                                <p class="help text-error">{{ $errors->first('category_id') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Thương hiệu <span class="text-danger">*</span></label>
                            <div class="form-group ">
                                <select class="selectpicker form-control" data-live-search="true" name="brand_id">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <p class="help text-error">{{ $errors->first('brand_id') }}</p>
                        <div class="form-group">
                            <label>Đơn giá</label>
                            <input type="text" class="form-control money" name="price" placeholder="Giá sản phẩm" min="0" value="0">
                            <p class="help text-error">{{ $errors->first('price') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" style="resize: none" rows="8"></textarea>
                            <p class="help text-error">{{ $errors->first('description') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control" name="content" placeholder="Nội dung" style="resize: none" rows="8"></textarea>
                            <p class="help text-error">{{ $errors->first('content') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="full-width">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" checked> Hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0"> Không hiển thị
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nhãn</label>
                            <div style="width: 100%" id="tags">
                                <input type="text" class="form-control tag" name="tags[]" placeholder="Nhãn sản phẩm" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info">Thêm mới</button>
                        <div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="{{asset('admin/ajax/product.js')}}"></script>

@endsection