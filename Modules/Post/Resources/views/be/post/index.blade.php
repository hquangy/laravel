@extends($pre_temp)

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12" style="padding: 0">
			<div class="box box-primary">

				<div class="box-header with-border">
					<h3 class="box-title">Danh sách {{ $title }}</h3>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i>
						</button>
{{-- 						<button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
							<i class="fa fa-times"></i>
						</button> --}}
					</div>
				</div>

				<div class="box-body">
					<table id="tableList" class="table table-striped table-hover">
						<thead>
							<tr>
							</tr>
						</thead>

						<tbody>
						</tbody>

						<tfoot class="clearfix">
						</tfoot>
					</table>
				</div>

				<div class="box-footer">

				</div>
			</div>
		</div>
	</div>
</section>
@stop

@section('script')
@endsection

@section('style')
@endsection
