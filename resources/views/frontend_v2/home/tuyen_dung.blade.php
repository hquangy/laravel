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
	<div class="container" style="padding-top: 10px;">
		<div class="container-body">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="text-center">{{ $page->title }}</h2>
					<hr class="body-hr">
					<div class="posts">
					{!! $page->content !!}
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection
@section('style')
@endsection

@section('script')
<script>
</script>
@endsection

