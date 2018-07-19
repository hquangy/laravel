@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<form role="form" action="{{ route($pre_view .'store') }}" method="post" enctype="multipart/form-data">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $title }}</h3>
						<div class="pull-right box-tools">
							<a class="btn btn-default" href="{{ route($pre_view. 'index') }}">
								Danh sách
							</a>
							<button type="submit" class="btn btn-primary" value="finished">Tạo mới</button>
						</div>
					</div>
					<div class="box-body">
						@include($pre_view .'_form',['mode'=>'create'])
						{{ csrf_field() }}
						<div class="box-footer">  
							<button type="submit" class="btn btn-primary" value="finished">Tạo mới</button>
						</div>
					</div>

					<div class="box-footer">

					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection