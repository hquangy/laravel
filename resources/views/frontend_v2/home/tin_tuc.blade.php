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
				@foreach(range(1,20) as $i)
				<?php $rand = rand(2,9); ?>
				@if($rand%2)
				<li>
				    <div class="box_news">
				        <div class="img_news"><a href="/tin-tuc/bai-viet-so-1"><img src="/images/com-1.jpg" alt="" class="img-responsive"></a></div>
				        <div class="txt_news">
				            <h3><a href="/tin-tuc/bai-viet-so-1">Lorem ipsum dolor sit amet.</a></h3>
				            <h5>20-05-2018</h5>
				            <p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, ipsa?
				            </p>
				        </div>
				        <div class="clearfix"></div>
				    </div>
				</li>
				@else
				<li>
				    <div class="box_news">
				        <div class="img_news"><a href="/tin-tuc/bai-viet-so-1"><img src="/images/com-1.jpg" alt="" class="img-responsive"></a></div>
				        <div class="txt_news">
				            <h3><a href="/tin-tuc/bai-viet-so-1">Lorem ipsum dolor sit amet.</a></h3>
				            <h5>20-05-2018</h5>
				            <p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut qui molestiae sint, corporis iste eum aliquam? Eaque animi corporis reprehenderit quidem tempore, repudiandae debitis alias consequuntur labore natus ad pariatur.
				            </p>
				        </div>
				        <div class="clearfix"></div>
				    </div>
				</li>
				@endif
				@endforeach
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

