@extends('frontend_v2.layout.frontend')
@section('content')

<div class="news">
	<br>
	<div class="page-title">
		<div class="page-title-content">
			<div class="page-title-left"><span class="narrow"></span></div>
			<div class="page-title-center nowrap"><h1 class="title-menu">{{ $title }}.</h1></div>
			<div class="page-title-right"></div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="container-body">
			<hr class="body-hr">
			<div class="lien-he">
				
				<div class="col-sm-6">
					<form class="well form-horizontal" action="{{ route('frontend.postLienHe')}}" method="post"  id="contact_form">
						<div class="alert alert-warning" style="text-align: justify;">
							Liên hệ với chúng tôi khi cần, nếu có thắc mắc hay phản hồi, xin vui lòng liên hệ với chúng tôi qua <b style="font-size: 18px"> HOTLINE 1900 2254 </b>hoặc điền đầy đủ thông tin vào mẫu dưới đây và gửi đến chúng tôi. Xin cám ơn sự ủng hộ của quý khách trong thời gian qua!
						</div>
						<h3 class="text-center">Thông tin liên hệ</h3>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-sm-3 control-label">Tên của bạn<span class="text-danger">*</span></label>  
							<div class="col-md-9 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input name="name" value="{{old('name')}}" placeholder="Nhập tên" class="form-control" type="text" required>
								</div>
								@if ($errors->has('name'))
								    <span class="help-block">
								        <strong>{{ $errors->first('name') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-sm-3 control-label">E-Mail<span class="text-danger">*</span></label>  
							<div class="col-sm-9 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input name="email" value="{{old('email')}}" placeholder="Nhập email của bạn" class="form-control" type="text" required>
								</div>
								@if ($errors->has('email'))
								    <span class="help-block">
								        <strong>{{ $errors->first('email') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							<label class="col-sm-3 control-label">Tiêu đề<span class="text-danger">*</span></label>  
							<div class="col-sm-9 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
									<input name="title" value="{{old('title')}}" placeholder="Nhập tiêu đề" class="form-control" type="text" required>
								</div>
								@if ($errors->has('title'))
								    <span class="help-block">
								        <strong>{{ $errors->first('title') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<!-- Success message -->
						@if (Session::has('success'))
						<div class="alert alert-success text-center" role="alert" id="success_message">
							<i class="glyphicon glyphicon-thumbs-up"></i><b>{!! Session::pull('success') !!}</b>
						</div>
						<script>
							$('.alert-success').delay({{ Session::has('alert-time') ? Session::pull('alert-time') : 10000 }}).fadeOut(1000);
						</script>
						@endif

						<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
							<label class="col-sm-3 control-label">Nội dung cần liên hệ<span class="text-danger">*</span></label>
							<div class="col-sm-9 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
									<textarea class="form-control" name="content" placeholder="Nhập nội dung bạn cần liên hệ" rows="5" required>{{old('content')}}</textarea>
								</div>
								@if ($errors->has('content'))
								    <span class="help-block">
								        <strong>{{ $errors->first('content') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						<!-- Button -->
						<div class="form-group">
							<label class="col-md-3 control-label"></label>
							<div class="col-md-4">
								<button type="submit" class="btn btn-warning">Gửi thông tin <span class="glyphicon glyphicon-send"></span></button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<h2 style="text-transform: uppercase;margin-top: 0" class="h2Hethong text-center">
							Hệ thống nhà hàng cơm tấm cali
						</h2>
					</div>
					<div class="row">
						<div class="form-group col-sm-6" style="padding-left: 0">
						    <select name="cities" id="cities" class="form-control cities" placeholder="Chọn thành phố">
						    	@foreach($cities as $city)
					            <option value="{{ $city->id }}" @if($city->id == 10958) selected="selected" @endif>
					            	{{ $city->title }}
					            </option>
					            @endforeach
						    </select>
						</div>
						<div class="form-group col-sm-6 divQuanHuyen">
							<select id="districts" placeholder="Tất cả các Quận Huyện">
								<option value="" selected="selected">
									Tất cả các Quận Huyện
								</option>
								@foreach($districts as $district)
								<option value="{{ $district->id }}">
									{{ $district->full_title }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<h3 class="page-title-header h3CityTitle" style="padding-top: 10px;text-transform: uppercase;"></h3>
						<div class="stores">
							@include('frontend_v2.lien_he._stores',compact('stores','city'))
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('style')
@endsection

@section('script')
<script src="/plugins/selectize/selectize.min.js"></script>
<script>
$('#districts').on('change', function(){
    const id = $('#districts').val();
    if(!id || id == -1){
        listByCity($('#cities').val());
        return;
    }
    listByDistrict(id);
});

$('.h3CityTitle').html($('#cities option:selected').text());
$('#cities').on('change', function(){
	$('.h3CityTitle').html($('#cities').text());
	const id = $('#cities').val();
	listByCity(id);
});

// selectize
var xhr;
var base_url_city = '/api/stores-by-city/', base_url_district = '/api/stores-by-district/';
$('#cities').selectize({
    sortField: 'text',
    persist: false,
    create: false,
    onChange: function(value) {
    	if (!value.length){
            select_loai.disable();
            select_loai.clearOptions();
            return;
        }
    	select_loai.disable();
    	select_loai.clearOptions();
    	select_loai.load(function(callback) {
    		xhr && xhr.abort();
    		xhr = $.ajax({
    			url: '/api/districts/'+value,
    			success: function(results) {
    				select_loai.enable();
    				callback(results);
    			},
    			error: function() {
    				callback();
    			}
    		})
    	});
    },
});
$select_loai = $('#districts').selectize({
	valueField: 'id',
    persist: false,
    create: false,
	labelField: 'full_title',
	searchField: ['full_title'],
	// sortField: 'text',
});
select_loai  = $select_loai[0].selectize;

function btn_loadmore_hethong(number)
{
    $(".item").slice(0, number).show();
    $(".xemthem a").on('click', function (e) {
        e.preventDefault();
        $(".item:hidden").slice(0, 5).slideDown();
        if ($(".item:hidden").length == 0) {
            $(".xemthem a").fadeOut('slow');
            $(".xemthem").css("border","none");
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 800);
    });
}

function listByDistrict(id){
    const url = base_url_district + id;
    $.get(url, function(data){
        $('.stores').html(data.data);
    });
}

function listByCity(id){
    const url = base_url_city + id;
    $.get(url, function(data){
        $('.stores').html(data.data);
    });
}
</script>
@endsection

