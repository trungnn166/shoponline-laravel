@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            @include('admin.components.message')
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('admin.categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Tên danh mục">
                            <p class="help text-error">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="Mô tả" style="resize: none" rows="8"></textarea>
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
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-info">Thêm mới</button>
                        <div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection