@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Chỉnh sửa Sản phẩm</h3>
					<div class="pull-right box-tools">
					  <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					    <i class="fa fa-minus"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
					    <i class="fa fa-times"></i></button>
					</div>
				</div>

				<form role="form" action="{{ route('backend.product.update',['id'=> $data['id']]) }}" method="post" enctype="multipart/form-data">
					<div class="box-body">
						@include('backend.product._form',['mode'=>'edit'])
						{{ csrf_field() }}
					</div>
					
					<div class="box-footer">
						<button type="submit" class="btn btn-success" name="action" value="finished">
							<i class="fa fa-floppy-o"></i>
							Cập nhật
						</button>
						
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
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
			  Bạn có muốn xóa Sản phẩm này không?
			</p>
	      </div>

	      <div class="modal-footer">
			<form method="POST" action="{{ route('backend.product.delete',['id'=>$data['id']])}}">
				{{ csrf_field() }}
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn btn-danger">
			    <i class="fa fa-times-circle"></i> Chấp nhận
			  </button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>
</section>
@endsection