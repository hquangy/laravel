@extends('frontend_v2.layout.frontend')
@section('content')
<?php
	$first_category = $categories->first();
?>
<div class="news">
	<br>
	<div class="page-title">
		<div class="page-title-content">
			<div class="page-title-left"><span class="narrow"></span></div>
			<div class="page-title-center nowrap"><h1 class="title-menu">{{ $title }}.</h1></div>
			<div class="page-title-right"></div>
		</div>
	</div>
	<br>
	<div class="container thuc-don" style="padding-left: 0;padding-right: 0">
		<div class="container-body">
		<hr class="body-hr">
			<h3 class="page-title-thuc-don" id="{{ $first_category->slug }}">
				<span>{{ $first_category->title}}</span> <br>
				{{ $first_category->en_title }}
			</h3>
			<div class="row">
				<div class="col-sm-12" style="padding: 1px">
					<img src="/images/cate-thuc-don/{{ $first_category->slug}}.jpg" alt="{{ $first_category->title}}" class="img-responsive">
				</div>
			</div>

			<?php $dem = 1;?>
			@foreach($categories as $key=>$category)
			@if($key)
			<h3 class="page-title-thuc-don" id="{{ $category->slug}}">
				<span>{{ $category->title }}</span> <br>
				{{ $category->en_title }}
			</h3>
			<div class="row">
				<div class="col-sm-6" style="padding: 1px">
					<img src="/images/cate-thuc-don/{{ $category->slug}}.jpg" alt="{{ $category->title }}" class="img-responsive">
				</div>
				<div class="col-sm-6">
					<br>
					<table class="table table-thuc-don">
						@foreach($category->products as $product)
						<tr>
							<td valign="top" style="padding-top: 6px">
								<span>{{ $dem }}.</span>
							</td>
							<td>
								<h3>{{ mb_strtoupper($product->title) }}</h3><br>
								{{ $product->en_title }}
							</td>
							<td>
								<span>{{ $product->htmlPrice() }}</span>
							</td>
						</tr>
						<?php $dem++ ?>
						@endforeach
					</table>
				</div>
				<div class="row">
					<div class="col-sm-12" style="padding: 0">
					<p class="text-center pVat">Giá chưa bao gồm 10% Thuế VAT | Prices subject to 10% VAT</p>
						
					</div>
				</div>
			</div>
			@endif
			@endforeach
		</div>
	</div>
</div>

@endsection
@section('style')
<style>
	.pVat{
		padding: 12px;
		background: #662d91;
		color: white;
		margin: 0 0 25px 0;
	}
</style>
@endsection

@section('script')
<script>
function offsetAnchor() {
	if (location.hash.length !== 0) {
		window.scrollTo(window.scrollX, window.scrollY - 39);
	}
}

$(document).on('click', '.menu-tag', function(event) {
	window.setTimeout(function() {
		offsetAnchor();
	}, 0);
});
</script>
@endsection