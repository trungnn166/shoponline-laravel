@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        {{ Breadcrumbs::render('admin.brands.edit') }}
        <section class="panel">
            <header class="panel-heading">
                Chỉnh sửa thương hiệu
            </header>
            @include('admin.components.message')
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('admin.brands.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$brand->id}}">
                        <input type="hidden" name="url" value="{{$brand->url}}">
                        <div class="form-group">
                            <label>Tên thương hiệu</label>
                            <input type="text" class="form-control" name="name" placeholder="Tên danh mục" value="{{$brand->name}}">
                            <p class="help text-error">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" style="resize: none" rows="8">{{$brand->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="full-width">
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" @if($brand->status) checked @endif> Hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" @if(!$brand->status) checked @endif> Không hiển thị
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