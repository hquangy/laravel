@extends('backend.layouts.admin')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Danh sách {{ $title }}</h3>
					<div class="pull-right box-tools">
						{{-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadModal">Upload excel</button> --}}
					</div>
					<hr>
					<div class="col-sm-12">
						<div class="row">
								
							<form action="{{ route('auth.callcenter.listAgentStates') }}" method="GET" id="formFilter" onsubmit="return false">

								<div class="form-group col-sm-3" style="padding: 2px">
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
												<input type="text" class="form-control daterange pull-right" id="created_at" name="created_at" placeholder="Lọc theo ngày tạo">
											</div>
										</div>
									</div>
								</div>
								{{-- end filter by daterange --}}

								<div class="form-group col-sm-2" style="padding: 1px">
									<label for="user" class="hidden-sm hidden-xs">&nbsp;</label>
									<button class="btn btn-primary btn-block" style="width: 66%" id="btnFilter">Lọc</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="divContent">
					@include('backend.callcenter.TableContentAgentState')
				</div> {{-- divContent --}}

			</div> {{-- end box-primary --}}
		</div>
	</div>
</section>
@endsection

@section('script')
<script src="/admin/js/filter.js"></script>
<script>
	$(document).ready(function(){
		filter.init();
		// for popover
	});
</script>
@endsection

@section('style')
@endsection