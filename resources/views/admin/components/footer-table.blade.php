<footer class="panel-footer">
    <div class="row">
        <div class="col-sm-12">
            <small class="text-muted inline m-t-sm m-b-sm">Hiển thị {{$data->firstItem()}}-{{$data->lastItem()}} trong {{$data->total()}} kết quả</small>
        </div>
        <div class="col-sm-8 text-right text-center-xs">
            {!! $data->links('admin.components.panigation') !!}
        </div>
    </div>
</footer>