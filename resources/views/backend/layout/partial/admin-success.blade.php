@if (Session::has('success'))
<div class="alert alert-success alert-dismissible text-center alert-absolute">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Success!</h4>
	{!! Session::pull('success') !!}
</div>
<script>
	$('div.alert-success').delay({{ Session::has('alert-time') ? Session::pull('alert-time') : 5000 }}).fadeOut(1000);
</script>
@endif