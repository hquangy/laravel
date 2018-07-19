@extends('frontend_v2.layout.frontend')
@section('content')
<div class="news">
	<br>
	<div class="page-title">
		<div class="page-title-content">
			<div class="page-title-left"><span class="narrow"></span></div>
			<div class="page-title-center nowrap"><h1 class="title-menu"><strong>{{ $title }}.</strong></h1></div>
			<div class="page-title-right"></div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="container-body">
			<hr class="body-hr">
			<div class="box_mid_promotion">
				<div class="row">
					{!! $page->content !!}
				</div>
			</div>
		</div>
	</div>
</div>
<br>
@endsection
@section('style')
@endsection

@section('script')
@endsection

