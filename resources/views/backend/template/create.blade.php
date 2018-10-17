@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<form role="form" action="{{ route($pre_view .'store') }}" method="post" enctype="multipart/form-data">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $title }} - Tạo mới</h3>
						<div class="pull-right box-tools">
							<a class="btn btn-default btn-sm" href="{{ route($pre_view. 'index') }}">
								Danh sách
							</a>
						</div>
					</div>
					<div class="box-body">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-sm" name="action" value="finished">Tạo mới</button>
							<button type="reset" class="btn btn-default btn-sm" name="action" value="finished">Nhập lại</button>

							<hr style="margin: 10px 0">
						</div>

						@include($pre_view .'_form',['mode'=>'create'])
						{{ csrf_field() }}
						<div class="box-footer">  
							<button type="submit" class="btn btn-primary btn-sm" name="action" value="finished">Tạo mới</button>
							<button type="reset" class="btn btn-default btn-sm" name="action" value="finished">Nhập lại</button>
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