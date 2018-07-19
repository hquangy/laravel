@extends('frontend_v2.layout.frontend')
@section('content')
@include('frontend_v2.layout.slider')
{{-- khuyến mãi section --}}
<div class="khuyen-mai row" style="padding-bottom: 15px;">
	<h3 class="page-title-header"><a href="{{ route('frontend.uu_dai') }}"><i class="fa fa-fire text-danger"></i>&nbsp;ƯU ĐÃI</a></h3>
	<div class="owl-khuyen-mai owl-carousel owl-theme">
		@foreach($uu_dais->chunk(2) as $uu_dai_chunk)
		<div class="item">
			@foreach($uu_dai_chunk as $uu_dai)
			<div class="imgWapper">
				<a href="{{ $uu_dai->link() }}">
					<img src="{{ $uu_dai->filename }}" alt="{{ $uu_dai->title }}" class="img-thumbnail" style="margin-bottom: 10px;">
				</a>
			</div>
			@endforeach
		</div>
		@endforeach
	</div>
</div>

{{-- danh mục sản phẩm --}}
<div class="danh-muc-san-pham row">
	<h3 class="page-title-header"><a href="{{ route('frontend.thuc_don') }}"><i class="fa fa-fire text-danger"></i>&nbsp;THỰC ĐƠN</a></h3>
	<div style="padding: 0 12px">
		<div class="owl-danh-muc owl-carousel owl-theme">
			@foreach($categories->chunk(2) as $category_chunk)
			<div class="item">
				@foreach($category_chunk as $category)
				<div class="imgWapper">
					<a href="/thuc-don#{{ $category->slug }}">
						<img src="/images/cate/{{ $category->slug}}.jpg" alt="{{ $category->slug }}" class="img-thumbnail">
					</a>
				</div>
				<h4 class="text-center"><a href="/thuc-don#{{ $category->slug }}" style="color: #590796">{{ $category->title }}</a></h4>
				@endforeach
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="video-media">
	<div class="owl-carousel owl-theme">
		<div class="item-video" data-merge="1" style="height: 312px;">
			<a class="owl-video" href="https://www.youtube.com/watch?v=lB8Sr8nXOBw"></a>
		</div>

		<div class="item-video" data-merge="1" style="height: 312px">
			<a class="owl-video" href="https://www.youtube.com/watch?v=h7EWnGSzDvg"></a>
		</div>
	</div>
</div>

@endsection
@section('style')
<link rel="stylesheet" href="/css/owl.carousel.min.css">
<link rel="stylesheet" href="/css/owl.theme.default.min.css">
@endsection

@section('script')
<script src="/js/owl.carousel.min.js"></script>
<script>
$(document).ready(function() {
	$('.owl-khuyen-mai').owlCarousel({
	    animateOut: 'slideOutDown',
	    animateIn: 'flipInX',
	    items:1,
	    margin:30,
	    stagePadding:30,
	    smartSpeed:450,
	    responsive:{
	        600:{
	            items:2,
	        },
	        1000:{
	            items:2,
	        }
	    }
	});

	$('.owl-danh-muc').owlCarousel({
	    loop:true,
	    margin:10,
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:3,
	            nav:false
	        },
	        1000:{
	            items:5,
	            loop:false
	        }
	    }
	});

	$('.owl-carousel').owlCarousel({
		items:1,
		merge:true,
		loop:true,
		margin:10,
		// nav: true,
		video:true,
		lazyLoad:false,
		center:true,
		responsive:{
			480:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:3,
			}
		},
		onTranslate: function() {
			$('.owl-item').find('video').each(function() {
				this.pause();
			});
		}
	});
});
</script>
@endsection

