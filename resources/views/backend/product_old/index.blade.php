@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Trang quản lý Sản phẩm</h3>
					<div class="pull-right box-tools">
					  <a href="{{ route('backend.product.create')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tạo mới">Tạo mới</a>
					  <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadModal">Upload excel</button>
{{-- 					  <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> --}}
					</div>
				</div>
				<div class="box-body">
					<table id="blog-table" class="table table-striped table-hover">
					    <thead>
					        <tr>
					          <th>Id</th>
					          <th>Tên</th>
					          <th>Tên (english)</th>
					          <th>Slug</th>
					          <th>Ẩn/Hiển</th>
					          <th>Sắp xếp</th>
					          <th>Danh mục</th>
					          <th>Hành động</th>
					      </tr>
					    </thead>
					
					    <tbody>
					    	@foreach($products as $product)
					        <tr>
					            <td>{{ $product->id}}</td>
					            <td>{{ $product->title }}</td>
					            <td>{{ $product->en_title }}</td>
					            <td>{{ $product->slug }}</td>
					            <td>{!! $product->visibility ? '<span class="label label-success">Hiện</span>' : '<span class="label label-danger">Ẩn</span>' !!}</td>
					            <td>{{ $product->boost }}</td>
					            <td>{{ $product->category ? $product->category->title : '' }}</td>
					            <td>
					            	<a href="{{ route('backend.product.edit',['id'=>$product->id])}}" class="btn btn-info btn-xs">
					            		<i class="fa fa-edit"></i>
					            	</a>
					            </td>
					        </tr>
					        @endforeach
					    </tbody>
					
					    <tfoot class="clearfix">
					    </tfoot>
					</table> {{-- end table --}}
				</div>

				<div class="box-footer">

				</div>
			</div>
		</div>
	</div>
</section>

{{-- Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Bảng xác nhận</h4>
			</div>

			<form method="POST" action="{{ route('backend.product.excelUpload')}}" enctype="multipart/form-data">
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
@endsection

@section('script')
<script src="{{ url('/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function(){
	$('#blog-table').DataTable(
		{
			// "order": [[ 2, "asc" ]]
			"ordering": false
		}
	);
})
</script>
@endsection

@section('style')
<link rel="stylesheet" href="{{ url('/datatables/dataTables.bootstrap.css')}}">
@endsection