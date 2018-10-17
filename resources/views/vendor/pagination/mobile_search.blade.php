@if ($paginator->hasPages())
    <div class="pagination2">
        @if (!$paginator->onFirstPage())
            <a id="prev" href="{{ $paginator->previousPageUrl() }}"><img src="{{ asset('frontend_v2/images/CSCN/left_arrow.png') }}"></a>
        @else
            {{--<a id="prev" style="display: none"><img src="{{ asset('frontend_v2/images/CSCN/left_arrow.png') }}"></a>--}}
        @endif

        <div class="page pull-center">
            <a href="#" class="cls1">Trang {{  $paginator->currentPage() }}</a>
        </div>

        @if ($paginator->hasMorePages())
            <a id="next" class="pull-right" href="{{ $paginator->nextPageUrl() }}"><img src="{{ asset('frontend_v2/images/CSCN/right_arrow.png') }}"></a>
        @endif
    </div>
@endif