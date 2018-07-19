@extends('frontend_v2.layout.frontend')
@section('content')

<div class="news">
	<br>
	<div class="page-title">
		<div class="page-title-content">
			<div class="page-title-left"><span class="narrow"></span></div>
			<div class="page-title-center nowrap"><h1 class="title-menu"><strong>{{ $title }}.</strong></h1></div>
			<div class="page-title-right"></div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="container-body">
		<hr class="body-hr">
		<?php $dem = 1;?>
		<h3 class="page-title-header">HỒ CHÍ MINH</h3>
		<div class="col-sm-12">
			<table class="table table-striped table-chi-nhanh">
				@foreach(range(1,rand(4,8)) as $j)
				<tr>
					<td>
						<strong class="chi-nhanh-name">{{ $dem}}. 48 Nguyễn Huệ, Quận 1</strong><br>
						<span class="chi-nhanh-phone"><a href="tel:02873000322">TEL: (028) 7300 0322</a></span><br>
						<span class="chi-nhanh-ban-do"><a href="http://maps.google.com/maps?q=48 Nguyễn Huệ, Quận 1" target="_new"><b>Bản đồ</b></a></span>
					</td>
					<td>
						<strong class="chi-nhanh-name">{{ $dem}}. 48 Nguyễn Huệ, Quận 1</strong><br>
						<span class="chi-nhanh-phone"><a href="tel:02873000322">TEL: (028) 7300 0322</a></span><br>
						<span class="chi-nhanh-ban-do"><a href="http://maps.google.com/maps?q=48 Nguyễn Huệ, Quận 1" target="_new"><b>Bản đồ</b></a></span>
					</td>
				</tr>
				<?php $dem++ ?>
				@endforeach
			</table>
		</div>

		</div>
	</div>
</div>

@endsection
@section('style')
@endsection

@section('script')
@endsection

