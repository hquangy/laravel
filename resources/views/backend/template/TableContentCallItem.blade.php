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
					<th>Từ số</th>
					<th>Đến số</th>
					<th>Mã cuộc gọi</th>
					<th>Loại cuộc gọi</th>
					<th>Trạng thái</th>
					<th style="display: none;">Sự kiện</th>
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
					<td>{{ $item->from_phone }}</td>
					<td>{{ $item->to_phone }}</td>
					<td>
						<a href="{{ route('auth.callcenter.login126',['call_id' => $item->call_id]) }}" target="popup" data-id="{{ $item->id }}">
							{{ $item->call_id }}
						</a>
						@if($item->is_checked_download)
							<i class="fa fa-download"></i>&nbsp;
						@endif

						@if($item->agent)
							<i class="fa fa-file-audio-o"></i>
						@endif
					</td>
					<td>{!! $item->type_call !!}</td>
					<td>{{ $item->state }}</td>
					<td style="display: none;">{{ $item->event_call }}</td>
					<td>{{ date_ft_full($item->created_at) }}</td>
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
					<th>ID</th>
					<th>Inside</th>
					<th>User Email</th>
					<th>Từ số</th>
					<th>Đến số</th>
					<th>Mã cuộc gọi</th>
					<th>Loại cuộc gọi</th>
					<th>Trạng thái</th>
					<th>Ngày tạo</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="15">
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