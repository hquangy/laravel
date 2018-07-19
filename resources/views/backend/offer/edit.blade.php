@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<form role="form" action="{{ route($pre_view .'update',['id'=> $data['id']]) }}" method="post" enctype="multipart/form-data">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $title }} - Cập nhật</h3>
						<div class="pull-right box-tools">
							<a class="btn btn-default btn-sm" href="{{ route($pre_view. 'index') }}">
								Danh sách
							</a>
							<a class="btn btn-primary btn-sm" href="{{ route($pre_view. 'create') }}">
								Tạo mới
							</a>
						</div>
					</div>

					<div class="box-body">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success btn-sm" name="action" value="finished">
								<i class="fa fa-floppy-o"></i>
								Cập nhật
							</button>

							<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-times-circle"></i>
								&nbsp;Xóa
							</button>
							<hr style="margin: 10px 0">
						</div>
						@include($pre_view .'_form',['mode'=>'edit'])
						{{ csrf_field() }}
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-success btn-sm" name="action" value="finished">
							<i class="fa fa-floppy-o"></i>
							Cập nhật
						</button>
						
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-times-circle"></i>
							&nbsp;Xóa
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	{{-- Modal --}}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bảng xác nhận xóa</h4>
				</div>

				<div class="modal-body">
					<p class="lead">
						<i class="fa fa-question-circle fa-lg"></i> &nbsp;
						Bạn có chắc sẽ xóa {{ $title }} <small class="deleteItemTitle bg-warning">{{ $data['title'] }}</small> chứ?
					</p>
				</div>

				<div class="modal-footer">
					<form method="POST" action="{{ route($pre_view.'delete',['id'=>$data['id']])}}">
						{{ csrf_field() }}
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
						<button type="submit" class="btn btn-danger btn-sm">
							<i class="fa fa-times-circle"></i> Chấp nhận
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection