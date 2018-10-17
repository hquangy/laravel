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
					<th>Call Id</th>
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
					<td>
						@if($item->call_id)
						<a tabindex="0"
						   class="btn btn-sm btn-primary"
						   data-placement="left"
						   role="button" 
						   data-html="true" 
						   data-toggle="popover" 
						   data-trigger="focus" 
						   title="<b>Thông tin cuộc gọi</b>" 
						   data-content="<div style='font-size:12px'>
						   	@foreach($item->calls as $key=>$call)
						   	<p><b>Loại:</b> {{ $call->type_call }}</p>
						   	<p><b>Trạng thái:</b> {{ $call->state }}, <b>Sự kiện:</b> {{ $call->event_call }}</p>
						   	<p><b>Thời gian gọi:</b> {{ date_ft_full($call->created_at) }}</p>
						   	<p><b>Gọi tới số:</b> {{ $call->to_phone }}</p>
						   	@if($key < count($item->calls)-1)<hr>@endif
						   	@endforeach
						    </div>">{{ $item->call_id }}
						</a>
						@endif
					</td>
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