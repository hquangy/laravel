@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Tạo Blog mới</h3>
					<div class="pull-right box-tools">
					  <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					    <i class="fa fa-minus"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
					    <i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="box-body">
					<form role="form" action="{{route('backend.blog.store') }}" method="post" enctype="multipart/form-data">
						@include('backend.blog._form',['mode'=>'create'])
						{{ csrf_field() }}
						<div class="box-footer">  
							<button type="submit" class="btn btn-primary" value="finished">Tạo mới</button>
						</div>
					</form>
				</div>

				<div class="box-footer">

				</div>
			</div>
		</div>
	</div>
</section>
@endsection