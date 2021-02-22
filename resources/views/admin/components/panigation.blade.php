@if ($paginator->hasPages())
    <ul class="pagination pagination-sm m-t-none m-b-none">
       
        @if ($paginator->onFirstPage())
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-chevron-left"></i></a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-chevron-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="fa fa-chevron-right"></i></span></li>
        @endif
    </ul>
@endif 