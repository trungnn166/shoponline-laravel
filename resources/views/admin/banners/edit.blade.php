@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Breadcrumbs::render('admin.banners.edit') }}
        <section class="panel">
            <header class="panel-heading">
                {{$title}}
            </header>
            @include('admin.components.message')
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('admin.banners.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$banner->id}}">
                        <input type="hidden" name="url" value="{{$banner->url}}">
                        <div class="form-group">
                            <label>Tên banner</label>
                            <input type="text" class="form-control" name="name" placeholder="Tên banner" value="{{$banner->name}}">
                            <p class="help text-error">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <img  class="img-thumbnail full-width mb-5px" id="image-preview" src="{{$banner->image}}" >
                            <input type="file" class="form-control" name="image" id="input-image">
                            <p class="help text-error">{{ $errors->first('image') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" style="resize: none" rows="8">{{$banner->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="full-width">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if($banner->status) checked @endif> Hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if(!$banner->status) checked @endif> Không hiển thị
                                </label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        <div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection