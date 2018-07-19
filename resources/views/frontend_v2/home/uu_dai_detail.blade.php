@extends('frontend_v2.layout.frontend')
@section('content')

<div class="news">
	<div class="container" style="padding-top: 45px;">
		<div class="container-body">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="text-center">{{ $uu_dai->title }}</h2>
					<hr class="body-hr">
					<div class="posts">
					{!! $uu_dai->content !!}
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
@endsection

