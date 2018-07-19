<?php $dem = 1;?>
<div class="col-sm-12">
	@if($stores->count() > 0)
	<table class="table table-striped table-chi-nhanh">
		<col width="40">
		<col>
		@foreach($stores as $store)
		<tr class="item">
			<td valign="top" style="padding-top: 4px">
				<span>{{ $dem}}.</span>
			</td>
			<td>
				<h3>{{ $store->title }}</h3>
				@if($store->phone)
				<span class="chi-nhanh-phone"><a href="tel:{{ $store->phone }}">TEL: (028) {{ $store->phone }}</a></span><br>
				@endif
				<span class="chi-nhanh-ban-do"><a href="http://maps.google.com/maps?q={{ $store->title }}" target="_new">Bản đồ</a></span>
			</td>
		</tr>
		<?php $dem++ ?>
		@endforeach
	</table>
	<hr>
	<div class="clearfix"></div>
{{-- 		@if($stores->count() > 5)
	<div class="xemthem text-center">
		<a href="#" class="btn btn-warning">Xem thêm</a>
	</div>
	<br>
	@endif --}}

	@else
	
	<h4>Hiện tại không có nhà hàng nào</h4>

	@endif
</div>