@extends('backend.layouts.admin')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Danh sách {{ $title }}</h3>
					<div class="pull-right box-tools">
					</div>
					<hr>
					<div class="col-sm-12">
						<form action="{{ route('auth.callcenter.listCallItems') }}" method="GET" id="formFilter" onsubmit="return false">
							<div class="row">
								
								<div class="col-sm-6" style="padding: 0 2px">
									<div class="form-group col-sm-4" style="padding: 0 2px;">
										<label for="col" class="hidden-sm hidden-xs">Chọn cột</label>
										<select name="col" id="col" class="form-control col" placeholder="Lọc theo User">
											@foreach ($data as $key=>$col)
											@if(isset($col['col']))
											<option value="{{ $key }}" @if(isset($col['selected'])) selected="selected" @endif>
												{{ $col['desc'] }}
											</option>
											@endif
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-8" style="padding: 0 2px">
										<label for="search" class="hidden-sm hidden-xs">Lọc theo từ khóa (Enter để lọc)</label>
										<input type="text" class="form-control" id="search" name="search" value="" placeholder="Nhập từ khóa">
									</div>
								</div>

								<div class="form-group col-sm-3" style="padding: 0 2px">
									<label for="inside_code" class="hidden-sm hidden-xs">Lọc theo User</label>
									<select name="inside_code" id="inside_code" class="form-control inside_code" placeholder="Lọc theo User">
										<option value="0" selected="selected">Tất cả</option>
										@foreach ($users_calllog as $user_calllog)
										<option value="{{ $user_calllog->inside_code }}">
											{{ $user_calllog->email }} - {{ $user_calllog->inside_code }}
										</option>
										@endforeach
									</select>

									<script>
										$(document).ready(function(){
											$('#inside_code').selectize({
												plugins: ['remove_button','drag_drop'],
												// sortField: 'text',
											});
										});
									</script>
								</div>

								{{-- start filter by daterange --}}
								<div class="form-group col-sm-3" style="padding: 0 2px">
									<label for="created_at" class="hidden-sm hidden-xs">Lọc theo ngày tạo</label>
									<div class="col-xs-12" style="padding: 0 2px">
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control daterange pull-right" id="created_at" name="created_at" placeholder="Lọc theo ngày tạo" data-placement="left">
											</div>
										</div>
									</div>
								</div>
								{{-- end filter by daterange --}}
							</div>

							<div class="row" style="margin-bottom: 15px">

								<div class="col-xs-2" style="padding:0 2px">
									<button class="btn btn-primary btn-block" id="btnFilter"><i class="fa fa-search"></i><span class="hidden-xs hidden-sm"> Lọc</span></button>
								</div>

								<div class="col-xs-2" style="padding: 0 2px">
									<button class="btn btn-default pull-right btn-block" id="btnReset"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Xóa lọc</span></button>
								</div>

								<div class="col-xs-2" style="padding: 0 2px">
									<button class="btn btn-success pull-right btn-block" id="btnExportExcel" name="btnExportExcel" value="true"><i class="fa fa-file-excel-o"></i><span class="hidden-xs hidden-sm"> Xuất Excel</span></button>
								</div>

							</div>

							{{-- start section tìm nâng cao --}}
							<div class="row tim-nang-cao" style="display: none;">

							</div>
							{{-- end section tìm nâng cao --}}
						</form>
					</div>
				</div>
				<div class="divContent">
					@include('backend.callcenter.TableContentCallItem')
				</div> {{-- divContent --}}
			</div> {{-- end box-primary --}}
		</div>
	</div>
</section>
@endsection

@section('script')
<script src="/admin/js/filter.js"></script>
<script>
	$('body').on('click','a[target="popup"]', function(e){
		e.preventDefault();
		var wnd = window.open($(this).attr('href'),'popup','width=300,height=300,scrollbars=no,resizable=no');
		setTimeout(function() {
			wnd.close();
		}, 10000);
		return false;
	});

	filter.init();
</script>
@endsection

@section('style')
@endsection