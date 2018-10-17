@if ($paginator->hasPages())
<div class="pagination2 row">
    <a id="prev" href="{{ $paginator->previousPageUrl() }}" @if($paginator->onFirstPage()) onclick="return false" @endif>
        <img src="/frontend_v2/images/CSCN/left_arrow.png" alt="">
    </a>
    <div class="page" class="pull-center">
        <div class="cls2">{{  $paginator->currentPage() }}</div>
    </div>
    <a id="next" class="pull-right" href="{{ $paginator->nextPageUrl() }}" @if(!$paginator->hasMorePages()) onclick="return false" @endif>
        <img src="/frontend_v2/images/CSCN/right_arrow.png" alt="">
    </a>
</div>
@endif