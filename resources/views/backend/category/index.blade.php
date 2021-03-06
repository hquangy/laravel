@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Trang quản lý Category</h3>
					<div class="pull-right box-tools">
					  <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
					    <i class="fa fa-minus"></i></button>
					  <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
					    <i class="fa fa-times"></i></button>
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
					          <th>Mô tả ngắn</th>
					          <th>Hành động</th>
					      </tr>
					    </thead>
					
					    <tbody>
					    	@foreach($categories as $category)
					        <tr>
					            <td>{{ $category->id}}</td>
					            <td>{{ $category->title }}</td>
					            <td>{{ $category->en_title }}</td>
					            <td>{{ $category->slug }}</td>
					            <td>{!! $category->visibility ? '<span class="label label-success">Hiện</span>' : '<span class="label label-danger">Ẩn</span>' !!}</td>
					            <td>{{ $category->boost }}</td>
					            <td>{{ word_limit($category->short_description,10) }}</td>
					            <td>
					            	<a href="{{ route('backend.category.edit',['id'=>$category->id])}}" class="btn btn-info btn-xs">
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
@endsection

@section('script')
<script src="{{ url('/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function(){
	$('#blog-table').DataTable(
		{
			// "order": [[ 2, "asc" ]]
			// "ordering": false
		}
	);
})
</script>
@endsection

@section('style')
<link rel="stylesheet" href="{{ url('/datatables/dataTables.bootstrap.css')}}">
@endsection