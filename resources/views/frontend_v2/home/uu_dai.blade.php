@extends('frontend_v2.layout.frontend')
@section('content')

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
	<div class="container">
		<div class="container-body">
		<hr class="body-hr">
		<div class="content_news">
			<ul id="waterfall">
				@foreach($uu_dais as $uu_dai)
				<li>
				    <div class="box_news">
				        <div class="img_news"><a href="{{ $uu_dai->link() }}"><img src="{{ $uu_dai->filename }}" alt="" class="img-responsive"></a></div>
				        <div class="txt_news">
				            <h3><a href="{{ $uu_dai->link() }}">{{$uu_dai->title }}</a></h3>
				            <h5>{{ getDateVN($uu_dai->created_at) }}</h5>
				            <p>
								{{ $uu_dai->short_description }}
				            </p>
				        </div>
				        <div class="clearfix"></div>
				    </div>
				</li>
				@endforeach
{{-- 				<li>
				    <div class="box_news">
				        <div class="img_news"><a href="/uu-dai/bai-viet-so-1"><img src="/images/uu-dai-4.jpg" alt="" class="img-responsive"></a></div>
				        <div class="txt_news">
				            <h3><a href="/uu-dai/bai-viet-so-1">Lorem ipsum dolor sit amet.</a></h3>
				            <h5>20-05-2018</h5>
				            <p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, alias.
				            </p>
				        </div>
				        <div class="clearfix"></div>
				    </div>
				</li>
				<li>
				    <div class="box_news">
				        <div class="img_news"><a href="/uu-dai/bai-viet-so-1"><img src="/images/uu-dai-5.jpg" alt="" class="img-responsive"></a></div>
				        <div class="txt_news">
				            <h3><a href="/uu-dai/bai-viet-so-1">Lorem ipsum dolor sit amet.</a></h3>
				            <h5>20-05-2018</h5>
				            <p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci unde esse magni enim maxime quo.
				            </p>
				        </div>
				        <div class="clearfix"></div>
				    </div>
				</li> --}}
			</ul>
		</div>
		</div>
	</div>
</div>

@endsection
@section('style')
@endsection

@section('script')
@endsection

