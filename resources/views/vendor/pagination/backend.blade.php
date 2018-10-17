@if ($paginator->hasPages())
<div class="row" style="background: #eee;margin: 0;border: 1px outset #ddd; border-radius: 3px;">
    <div class="col-xs-12 col-sm-12 col-md-6" style="padding: 0 2px">
        <ul class="pagination" style="margin: 20px 0 0 0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" data-page="{{ $paginator->currentPage() -1 }}">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url}}" data-page="{{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl()}}" rel="next" data-page="{{ $paginator->currentPage() +1 }}">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-2 pull-left" style="padding: 0 2px;margin: 20px 0 0 0">
        <div class="input-group">
            <span class="input-group-addon" title="Rows per page"><i class="glyphicon glyphicon-th-list"></i></span>
            <select class="form-control rowPerPage">
               <option value="10">10</option>
               <option value="20">20</option>
               <option value="30">30</option>
               <option value="40">40</option>
             </select>
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-2 pull-left" style="padding: 0 2px;margin: 20px 0 0 0">
        <div class="input-group">
            <input id="pageNumber" type="number" class="form-control small-input" value="{{ $paginator->currentPage() }}">
            <span class="input-group-addon btnGoToPage"><i class="glyphicon glyphicon-arrow-right" style="cursor: pointer;"></i></span>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-2 pull-left" style="padding: 0 2px;margin: 20px 0">
        Có <strong>{{ $paginator->total() }}</strong> kết quả tìm thấy (trang <b>{{ $paginator->currentPage() }}</b>/{{$paginator->lastPage()}})
    </div>
</div>
@endif
