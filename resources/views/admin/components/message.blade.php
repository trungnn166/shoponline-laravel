<div class="flash-message" id="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }}">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="mt-2">
                    <i class="{{ Session::get('alert-' . $msg)['icon'] }}"></i> <label>{{ Session::get('alert-' . $msg)['message'] }}<span>
                </p>
            </div>
        @endif
    @endforeach
</div>