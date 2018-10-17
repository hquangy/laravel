@if(count($items))
<div class="box-body">
	<div class="table-responsive">
{{-- 		<p class="text-center">
			Có <strong>{{ $items->total() }}</strong> kết quả tìm thấy (trang <b>{{ $items->currentPage() }}</b>/{{$items->lastPage()}})
		</p> --}}

		<table class="table table-striped table-hover datatables">
			<col>
			<col>
			<col width="300">
			<thead>
				<tr>
					<th>
						<input type="checkbox" value="" class="checkAll">
					</th>
					@foreach($data as $col)
						@if(isset($col['col_table']))
							<th @if(isset($col['col_order'])) class="sortable" @endif>{{ $col['desc'] }} @if(isset($col['col_order'])) <i class="fa fa-sort" aria-hidden="true"></i> @endif</th>
						@endif
					@endforeach
					<th>Hành động</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $item)
				<tr>
					<td>
						<input type="checkbox" value="" class="check" data-id="{{ $item->id }}">
					</td>
					<td>{{ $item->id }}</td>
					<td>{{ $item->title }}</td>
					<td>{{ $item->order }}</td>
					<td>{{ $item->visibility }}</td>
					<td>{{ $item->slug }}</td>
					<td>{{ $item->short_description }}</td>
					<td>{{ $item->filename }}</td>
					<td>
						<div class="btn-group">
							<button class="btn btn-primary btn-sm btnEdit"><i class="fa fa-pencil-square-o"></i><span class="hidden-xs hidden-sm" data-id="{{ $item->id }}"> Chỉnh sửa</span></button>
							<button class="btn btn-danger btn-sm btnDelete"><i class="fa fa-times-circle"></i><span class="hidden-xs hidden-sm" data-id="{{ $item->id }}"> Xóa</span></button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot class="clearfix">
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
					@foreach($data as $col)
						@if(isset($col['col_table']))
							<th @if(isset($col['col_order'])) class="sortable" @endif>{{ $col['desc'] }} @if(isset($col['col_order'])) <i class="fa fa-sort" aria-hidden="true"></i> @endif</th>
						@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="{{ count($data) }}">
						<h3 class="text-center text-danger">Không có kết quả</h3>
					</td>
				</tr>
			</tbody>
			<tfoot class="clearfix">
			</tfoot>
		</table> {{-- end table --}}
	</div> {{-- end table-responsive --}}
</div>
<div class="box-footer">
</div>
@endif