@extends('backend.layouts.admin')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $title }} - Danh sách</h3>
					<div class="pull-right box-tools">
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadModal">Upload excel</button>
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover datatables">
							<thead>
								<tr>
									<th>ID</th>
									<th>Inside</th>
									<th>Extenstions</th>
									<th>Trạng thái</th>
									<th>Ngày tạo</th>
								</tr>
							</thead>
							<tbody>
								@foreach($items as $item)
								<tr>
									<td>{{ $item->id }}</td>
									<td>{{ $item->inside_code }}</td>
									<td>{{ $item->agent }}</td>
									<td>{{ $item->state }}</td>
									<td>{{ date_ft_full($item->updated_at) }}</td>
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
@endsection

@section('script')
<script src="/admin/js/table.js"></script>
<script>
	$(document).ready(function(){
		$('.datatables').DataTable({
				"order": [],
			}
		);
	})
</script>
@endsection

@section('style')
@endsection