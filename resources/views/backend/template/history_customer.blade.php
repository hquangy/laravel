@extends('backend.layouts.admin')

@section('content')
<script>
	$('body').addClass('sidebar-collapse');
	$('h1').hide();
	$('.breadcrumb').hide();
</script>
<section class="content" style="padding: 0 4px;margin: 0">
	<div class="row">
		<div class="col-sm-12">

			<div class="box box-primary" style="height: 400px;overflow-y: scroll;">
				<div class="box-header with-border">
					<h3 class="box-title">Lịch sử Đơn hàng của số: {{ $phone }}</h3>
					<div class="pull-right box-tools">
						@ability('owner','order-create')
						<a href="{{url('auth/order/create')}}" class="btn btn-primary btn-sm">Tạo đơn</a>
						@endability
					</div>
				</div>

				<div class="box-body" style="font-size: 13px;">
					@if(count($orders))
					<div class="table-responsive">
						<table id="candidate-table" class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Mã ĐH Ecom </th>
									<th>Tên KH</th>
									<th>Cửa hàng</th>
									<th>Số điện thoại</th>
									<th>Tên Sản phẩm</th>
									<th>Thành phố</th>
									<th>Quận</th>
									<th>Địa chỉ</th>
									<th>Tình trạng</th>
									<th>Tình trạng mDelivery</th>
									<th>Ngày giao dự kiến</th>
									<th>Tổng giá trị</th>
									<th>Người tạo</th>
									<th>NV đảm trách</th>
									<th>Ngày tạo</th>
									<th>Ngày duyệt</th>
									<th data-sortable="false" width="100px">Hành động</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
									@php
									if($order->ticked_at){
										$show=true;
									}else{
										if(Auth::user()->hasRole(['owner', 'order-owner'])){
											$show=true;
										}else{
											$show=false;
										}
									}
									@endphp
									<tr>
										<td>{{ $order->id }}</td>
										<td>
											@if($show)
				                            {{ $order->ho_ten }}
				                            @endif
				                        </td>
										<td>
											@if($show)
				                            {{ isset($order->store->name) ? $order->store->name : 'Chưa có shop' }}
				                            @endif
				                        </td>
										<td>
											@if($show)
				                            {{ $order->customer?$order->customer->dien_thoai_1:"" }}
				                            @endif
				                        </td>
										<td>
											@if($show)
												@if(count($order->orderDetails))
													<a href="{{ url('/auth/order/product/'.$order->orderDetails->where('product_id','<>',null)->first()->product->id) }}" target="_blank">{{$order->orderDetails->where('product_id','<>',null)->first()->product->web_name}}</a>
												@endif
				                            @endif
										</td>
										<td>
											@if($show)
				                            {{ $order->beThanhPho ? $order->beThanhPho->title : '' }}
				                            @endif
				                        </td>
										<td>
											@if($show)
				                            {{ $order->beQuan ?  $order->beQuan->title : ''}}
				                            @endif
				                        </td>
										<td>
											@if($show)
				                            {{ $order->dia_chi }}
				                            @endif
				                        </td>
										<td>{!! $order->getTinhTrang() !!} </td>
										<td>
											@if($show)
				                            {{ $order->m_delivery_status }}
				                            @endif
				                        </td>
										<td>{{ $order->ngay_giao_hang?date_ft_full($order->ngay_giao_hang):'' }}</td>
										<td>
											@if($show)
											<span class="currency">{{ $order->tong_gia }}</span>
				                            @endif
										</td>
										<td>

				                            {{ $order->user ? $order->user->name : 'Khách hàng' }}

				                        </td>
										<td>
											@if($show)
				                            {{ $order->user_viewing?$order->userViewing->name:''}}
				                            @endif
				                        </td>
										<td>{{ date_ft_full($order->created_at) }}</td>
				                        <td>{{ $order->ticked_at?date_ft_full($order->ticked_at):'' }}</td>
										<td>
											<a href="{{route('order.show',$order->id)}}" title="Xem chi tiết" class="btn btn-default btn-xs">
												<i class="fa fa-eye"></i>
											</a>
											@php 
												if($order->user_viewing){
													$unhref   = (Auth::user()->id == $order->user_viewing) ? '' : ' unhref';
													$waiting  = (Auth::user()->id == $order->user_viewing) ? '' : ' unhref';
												}else {
													$unhref = '';
													$waiting = '';
												}
												
												if(!$order->user_id){
													$unhref = '';
												}
												
												$holding  = (Auth::user()->id == $order->user_viewing) ? 'btn btn-warning btn-xs' :'btn btn-info btn-xs';
												$editable = (Auth::user()->id == $order->user_viewing) ? 'btn btn-warning btn-xs' :'btn btn-primary btn-xs';	
									    	@endphp
									    	
									    	@ability(['owner','order-admin'],'order-edit')
											@if($order->is_expired)
												<a href="{{route('order.clone',$order->id)}}" class="btn btn-success btn-xs" title="Clone đơn">
													<i class="fa fa-copy"></i>
												</a>
											@else
												@switch($order->tinh_trang)
												    @case(config('nhathuoc.order.holding'))
												        <a href="{{route('order.edit',$order->id)}}" class="{{ $holding.$waiting}}" title="Hoàn tất đơn">
															<i class="fa fa-hourglass-half"></i>
														</a>
												        @break

												    @case(config('nhathuoc.order.open'))
												        <a href="{{route('order.edit',$order->id)}}" class="{{ $editable.$unhref}}" title="Sửa đơn">
															<i class="fa fa-edit"></i>
														</a>
												        @break

													@case(config('nhathuoc.order.waiting'))
												        <a href="{{route('order.edit',$order->id)}}" class="{{ $editable.$waiting}}" title="Duyệt đơn">
															<i class="fa fa-edit"></i>
														</a>
														@break

												    @default
												        <a href="{{route('order.clone',$order->id)}}" class="btn btn-success btn-xs" title="Clone đơn">
															<i class="fa fa-copy"></i>
														</a>
												@endswitch
											@endif
											@endability

											@if(config('nhathuoc.removable_order'))
												@ability(['owner','order-admin'],'')
													<a href="{{route('order.delete',$order->id)}}" onclick="return confirm('Bạn có chắc muốn xóa đơn này!')" class="btn btn-danger btn-xs" title="Xóa đơn"> 
														<i class="fa fa-times"></i>
													</a>
												@endability
											@endif

										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

					</div>
					<script>
						$(".currency").text(function(i, text) {
							return parseInt(text).toLocaleString() +' đ';
						});
					</script>
					@else
						<h3 class="text-danger text-center">Chưa có đơn hàng nào</h3>
					@endif
				</div>

				<div class="box-footer">
				</div>
			</div>

			<div class="box box-success" style="height: 600px;overflow-y: scroll;">
				<div class="box-header with-border">
					<h3 class="box-title">Lịch sử Cuộc gọi của số: {{ $phone }}</h3>
					<div class="pull-right box-tools">
						<strong>{{ $callitems->count() }}</strong> kết quả tìm thấy.
					</div>
				</div>
				<div class="box-body">
					@if(count($callitems))
					<div class="table-responsive">
						<table class="table table-striped table-hover tableCallItem">
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
								@foreach($callitems as $key=>$item)
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
										{{ $item->call_id }}
									</td>
									<td>{!! $item->type_call !!}</td>
									<td>{{ $item->state }}</td>
									<td style="display: none;">{{ $item->event_call }}</td>
									<td>{{ date_ft_full($item->created_at) }}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								
							</tfoot>
						</table> {{-- end table --}}
					</div> {{-- end table-responsive --}}
					@else
						<h3 class="text-danger text-center">Chưa có đơn hàng nào</h3>
					@endif
				</div>

				<div class="box-footer">
				</div>
			</div>

		</div>
	</div>
</section>
@endsection