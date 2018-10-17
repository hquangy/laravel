@if(count($items))
<div class="box-body">
	<div class="table-responsive">
		<p>
			Có <strong>{{ $items->total() }}</strong> kết quả tìm thấy (trang <b>{{ $items->currentPage() }}</b>/{{$items->lastPage()}})
		</p>
		<table class="table table-striped table-hover datatables">
			<thead>
				<tr>
					<th>ID</th>
					<th>Inside</th>
					<th>User Email</th>
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
					<td>
						@if($item->user)
						{{ $item->user->email}}
						@else
						<span>???</span>
						@endif
					</td>
					<td>{{ $item->agent }}</td>
					<td>{{ $item->state }}</td>
					<td>{{ date_ft_full($item->created_at) }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
			</tfoot>
		</table> {{-- end table --}}
	</div> {{-- end table-responsive --}}
</div>
<div class="box-footer">
	<div class="text-center">
		{!! $items->appends(Illuminate\Support\Facades\Input::except('page'))->links('vendor.pagination.backend') !!}
	</div>
</div>
@else
	<div class="box-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover datatables">
				<thead>
					<tr>
						<th>ID</th>
						<th>Inside</th>
						<th>User Email</th>
						<th>Extenstions</th>
						<th>Trạng thái</th>
						<th>Ngày tạo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="6">
							<h3 class="text-center text-danger">Không có kết quả</h3>
						</td>
					</tr>
				</tbody>
				<tfoot>
				</tfoot>
			</table> {{-- end table --}}
		</div> {{-- end table-responsive --}}
	</div>
	<div class="box-footer">

	</div>
@endif