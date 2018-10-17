<?php
    $request = app()->make('request');
    $orderby = $request->orderby ? $request->orderby : 'boost-desc';
?>
@if ($paginator->hasPages())
    <div class="hidden-md hidden-lg pagination-mobile">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
        <div class="pull-left">
            <a href="{{ $paginator->previousPageUrl() .'&orderby='.$orderby}}">
                <img src="{{url('frontend/images/left-m.png')}}">
            </a>
        </div>
        @endif

        <strong>{{  $paginator->currentPage() }}</strong>

        @if ($paginator->hasMorePages())
        <div class="pull-right">
            <a href="{{ $paginator->nextPageUrl() .'&orderby='.$orderby }}">
                <img src="{{url('frontend/images/right-m.png')}}">
            </a>
        </div>
        @endif
    </div>
@endif

<style>
    @media (max-width: 480px){.pagination-mobile strong {font-size: 15px; text-align: center; color: #8c8c89; display: block;margin-top: 15px} 
</style>