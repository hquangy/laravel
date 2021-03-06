@extends('backend.layout.temp')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Danh sách {{ $title }}</h3>
					<div class="pull-right box-tools">
						<div class="pull-right box-tools">
						</div>
					</div>
					<hr>
					<div class="col-sm-12">
						<form action="{{ route($route.'index') }}" method="GET" id="formFilter" onsubmit="return false">
							<div class="row">
								
								@if(true)
								<div class="col-sm-9" style="padding: 0 2px">
									<div class="form-group col-sm-3" style="padding: 0 2px;">
										<label for="col" class="hidden-sm hidden-xs">Chọn cột</label>
										<select name="col" id="col" class="form-control col" placeholder="Lọc theo User">
											@foreach ($data as $key=>$col)
											@if(isset($col['col_filter']))
											<option value="{{ $key }}" @if(isset($col['col_filter_select'])) selected="selected" @endif>
												{{ $col['desc'] }}
											</option>
											@endif
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-3" style="padding: 0 2px;">
										<label for="operators" class="hidden-sm hidden-xs">Toán tử</label>
										<select name="operators" id="operators" class="form-control operators" placeholder="Toán tử">
											@foreach ($operators as $key=>$operator)
											<option value="{{ $operator }}">
												{{ $key }}
											</option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-6" style="padding: 0 2px">
										<label for="search" class="hidden-sm hidden-xs">Lọc theo từ khóa (Enter để lọc)</label>
										<input type="search" class="form-control" id="search" name="search" value="" placeholder="Nhập từ khóa">
									</div>
								</div>
								@endif

								@if(false)
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
								@endif

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
									<button class="btn btn-default btn-block" id="btnReset"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Xóa lọc</span></button>
								</div>

								<div class="col-xs-2" style="padding: 0 2px">
									<button class="btn btn-success btn-block" id="btnExportExcel" name="btnExportExcel" value="true"><i class="fa fa-file-excel-o"></i><span class="hidden-xs hidden-sm"> Xuất Excel</span></button>
								</div>

								<div class="col-xs-2" style="padding: 0 2px">
									<button class="btn btn-warning btn-block" id="btnImportExcel" name="btnImportExcel" value="true"><i class="fa fa-upload"></i><span class="hidden-xs hidden-sm"> Nhập Excel</span></button>
								</div>
							</div>

							{{-- start section tìm nâng cao --}}
							<div class="row tim-nang-cao" style="display: none;">

							</div>
							{{-- end section tìm nâng cao --}}
							<div class="row">
								<p class="text-center urlQueryString">
									
								</p>
							</div>
						</form>
					</div>
				</div>
				<div class="divContent">

				</div> {{-- divContent --}}
			</div> {{-- end box-primary --}}
		</div>
	</div>
</section>

{{-- modal upload excel --}}
<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="POST" action="{{ route($route. 'excelUpload')}}" enctype="multipart/form-data" id="formExcelImport">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Bảng xác nhận Import</h4>
				</div>

				<div class="modal-body">
					<p class="lead">
						<i class="fa fa-question-circle fa-lg"></i> Chọn file Excel để upload
					</p>
					<div class="form-group">
						<label for="fileExcelImport">Chọn file excel</label> <span class="text-danger"> *</span>
						<input type="file" class="form-control" name="fileExcelImport" id="fileExcelImport">
						<span class="text-danger error"></span>
					</div>
				</div>

				<div class="modal-footer">
					{{ csrf_field() }}
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-danger">
						<i class="fa fa-times-circle"></i> Chấp nhận
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="/backend/js/filter.js"></script>
<script>
	$(document).ready(function(){
	});
	filter.init();
</script>
@endsection

@section('style')
@endsection