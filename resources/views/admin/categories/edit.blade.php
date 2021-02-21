@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Breadcrumbs::render('admin.categories.edit') }}
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa danh mục
            </header>
            @include('admin.components.message')
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('admin.categories.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <input type="hidden" name="url" value="{{$category->url}}">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Tên danh mục" value="{{$category->name}}">
                            <p class="help text-error">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" style="resize: none" rows="8">{{$category->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="full-width">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if($category->status) checked @endif> Hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if(!$category->status) checked @endif> Không hiển thị
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