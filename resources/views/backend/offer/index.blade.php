@extends('backend.layout.temp')

@section('content')
<section class="content" style="padding: 0">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $title }} - Danh sách</h3>
					<div class="pull-right box-tools">
						<a href="{{ route($pre_view. 'create')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tạo mới">Tạo mới</a>
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadModal">Upload excel</button>
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover datatables">
							<thead>
								<tr>
									<th>ID</th>
									<th>Tên</th>
									<th>Slug</th>
									<th>Ẩn/Hiển</th>
									{{-- <th>Xóa</th> --}}
									<th>Sắp xếp</th>
									<th>Ngày cập nhật</th>
									<th width="140px">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach($items as $item)
								<tr>
									<td>{{ $item->id }}</td>
									<td>{{ $item->title }}</td>
									<td>{{ $item->slug }}</td>
									<td>{!! $item->visibility ? '<span class="label label-success">Hiện</span>' : '<span class="label label-danger">Ẩn</span>' !!}</td>
{{-- 									<td>
										@if($item->trashed()) 
											<span class="label label-danger">Xóa</span>
										@endif
									</td> --}}
									<td>{{ $item->order }}</td>
									<td>{{ date_ft_full($item->updated_at) }}</td>
									<td>
										<a href="{{ route($pre_view .'edit',['id'=>$item->id])}}" class="btn btn-warning btn-sm">
											<i class="fa fa-edit"></i> Chỉnh sửa
										</a>
										<button type="button" class="btn btn-danger btn-sm deleteBtn" data-id="{{ $item->id }}" data-title="{{ $item->title }}">
											<i class="fa fa-times-circle"></i>
											&nbsp;Xóa
										</button>
									</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot class="clearfix">
							</tfoot>
						</table> {{-- end table --}}
					</div>
				</div>
				<div class="box-footer">

				</div>
			</div>
		</div>
	</div>
</section>

{{-- Modal Upload --}}
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bảng xác nhận Import</h4>
			</div>

			<form method="POST" action="{{ route($pre_view. 'excelUpload')}}" enctype="multipart/form-data">
				<div class="modal-body">
					<p class="lead">
						<i class="fa fa-question-circle fa-lg"></i> &nbsp;
						Vui lòng chọn file Excel để upload
					</p>
					<div class="form-group">
						<label for="filename">Chọn file excel</label>
						<input type="file" class="form-control" name="filename" id="filename">
					</div>
				</div>

				<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-danger">
						<i class="fa fa-times-circle"></i> Chấp nhận
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{-- Modal Xóa --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<form method="POST" action="" class="deleteForm">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bảng xác nhận xóa</h4>
				</div>

				<div class="modal-body">
					<p class="lead">
						<i class="fa fa-question-circle fa-lg"></i> &nbsp;
						Bạn có chắc sẽ xóa {{ $title }} <small class="deleteItemTitle bg-warning"></small> chứ?
					</p>
				</div>

				<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-danger deleteBtnSubmit">
						<i class="fa fa-times-circle"></i> Chấp nhận
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script src="{{ url('/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.datatables').DataTable({
			"order": [],
		}
		);

		$('.deleteBtn').click(function(e){
			e.preventDefault();
			var deleteForm = $('.deleteForm'), deleteItemTitle = $('.deleteItemTitle');
			deleteItemTitle.html($(this).data('title'));
			deleteForm.attr('action', '/admin/offer/delete/' + $(this).data('id'));
			$("#deleteModal").modal();
		});
	})
</script>
@endsection

@section('style')
<link rel="stylesheet" href="{{ url('/datatables/dataTables.bootstrap.css')}}">
@endsection