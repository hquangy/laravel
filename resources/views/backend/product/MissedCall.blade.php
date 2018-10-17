<div class="table-responsive">
	<p>
		Có <strong>{{ $items->total() }}</strong> kết quả tìm thấy (trang <b>{{ $items->currentPage() }}</b>/{{$items->lastPage()}})
	</p>
	<table class="table table-striped table-hover datatables">
		<thead>
			<tr>
				<th>ID</th>
				<th>Số cuộc gọi vào</th>
				<th>Số cuộc gọi ra</th>
				<th>Số điện thoại</th>
				<th>Thời gian gọi lại</th>
				<th>NV Phụ trách</th>
				<th>Ngày tạo</th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td>{{ $item->QtyCallIn }}</td>
				<td>{{ $item->QtyCallOut }}</td>
				<td>{{ $item->CustPhone }}</td>
				<td>
					@if(!$item->recall_cisco)
						<span>Chưa xử lý</span>
					@else
						<span>{{ date_ft_full($item->recall_cisco) }}</span>
					@endif
				</td>
				<td>
					{{  optional($item->user)->email }}
				</td>
				<td>{{ date_ft_full($item->created_at) }}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot class="clearfix">
		</tfoot>
	</table> {{-- end table --}}
</div> {{-- end table-responsive --}}