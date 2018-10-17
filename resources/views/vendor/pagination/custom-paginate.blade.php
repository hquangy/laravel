@php
    $start = 1;
    $end = 7;
    $currentPage = $paginator->currentPage();
    $totalPage = $paginator->lastPage();

    if ($totalPage < 7) {
		$end = $totalPage;
	}
	if ($currentPage > 3 && $totalPage > 7) {
		$start = $currentPage - 2;
		if ($currentPage < $totalPage - 2) {
			$end = $currentPage + 2;
		} else {
			$end = $totalPage;
		}
	}
@endphp

@if ($paginator->hasPages())
    <ul class="pagination">
        @if (!$paginator->onFirstPage())
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @for($i = $start; $i <= $end; $i++)
            @if ($i == $currentPage)
                <li class="active"><span>{{ $i }}</span></li>
            @else
                <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @endif
    </ul>
@endif
