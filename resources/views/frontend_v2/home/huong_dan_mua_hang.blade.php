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
			<div class="row">
				<div class="col-sm-12">
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
	$('#contact_form').submit(function(e){
	    e.preventDefault();
	    // $('#success_message').slideDown({ opacity: "show" }, "slow"); // Do something ...
	    // $('#contact_form').data('bootstrapValidator').resetForm();
	    // $(this).trigger('reset');

	    // setTimeout(function(){
	    //     $('#success_message').slideUp({ opacity: "show" }, "slow");
	    // },4000);
	});
</script>
@endsection

