@extends('backend.layouts.admin')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $title }}</h3>
					<div class="pull-right box-tools">
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUpdateInside">Cập nhật thông tin inside</button>
					</div>
				</div>

				<div class="box-body">
					<div class="row">
						<div class="form-group col-sm-4" style="padding: 1px">
							<div class="btnlogaccount pull-right">
								<button class="logaccount btn btn-primary" type="button" id="form-agent-signin" onclick="signin();">Đăng nhập CISCO</button>
							</div>
						</div>

						<div class="form-group col-sm-4" style="padding: 1px">
							<select id="currentState" class="form-control"></select>
						</div>

						<div class="form-group col-sm-4" style="padding: 1px">
							<button type="button" class="logaccount btn btn-default" value="GET Agent State" id="get-agent-state" style="display: none;">Làm mới</button>
						</div>
					</div>
					<hr>

					<div class="row divThongTinCuocGoi" style="display: none;">
						<div class="form-group col-sm-6">
							<label for="field-call-control-callid">Mã số cuộc gọi</label>
							<input type="text" id="field-call-control-callid" class="form-control col-sm-6" readonly>
						</div>

						<div class="form-group col-sm-12">
							<button class="btn btn-danger" type="button" value="DROP Call" id="button-call-control-drop">Drop Call</button>
							<button class="btn btn-success" type="button" value="ANSWER Call" id="button-call-control-answer">Answer Call</button>
						</div>
					</div>
					
					<div class="row">
						<div class="boxState">
							<div class="form-group col-sm-6">
								<input type="text" id="field-call-control-make-dialnum" placeholder="Nhập số Phone cần gọi" class="form-control">
								{{-- <p class="makeCallStatus"></p> --}}
							</div>

							<div class="form-group col-sm-12">
								<button type="submit" value="MAKE Call" id="clicktocall" class="btn btn-success">Gọi ngay</button>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<h3 class="text-center bg-danger" style="padding: 10px;border-radius: 10px">Cuộc gọi nhỡ trong ngày
								<button type="button" class="btn btn-primary btn-sm updateNow"></button>
								<button type="button" class="btn btn-default btn-sm autoUpdate" style="display: none;">Tự động cập nhật</button>
							</h3>
							<div class="divMissedCall">
								
							</div>
						</div>
					</div>

				</div>
				{{-- end box-body --}}
				<div class="box-footer">

				</div>
			</div>
		</div>
	</div>
</section>
{{-- Modal Cập nhật thông tin --}}
@include('backend.callcenter.modelUpdateUserInfo')
@endsection

@section('script')
<script>
	var _username = '{{ Auth::user()->inside_code }}', _password = '{{ Auth::user()->inside_pass }}', _groupid = '3', _extension = '{{ Auth::user()->extensions }}';
	var auth_user_id = '{{ Auth::user()->id }}';
	var x, y, distance = 60;
	getMissedCallUser();

	$(document).ready(function(){
		$('body').on('click','.updateNow', function(){
			var btn = $(this);
			btn.prop('disabled', true);
			clearInterval(x);
			clearInterval(y);
			stopAuto();
			$.get('/auth/callcenter/log/getMissedCallUser', function(res){
				$('.divMissedCall').html(res.view);
				btn.prop('disabled', false);
			});
		});

		$('body').on('click','.autoUpdate', function(){
			continueAuto();
			getMissedCallUser();
		});

		y = setInterval(function(){
			console.log('Cập nhật mới');
			getMissedCallUser();
		}, distance*1000);
	});

	function stopAuto()
	{
		$('.autoUpdate').show();
		$('.updateNow').html('Cập nhật ngay');
	}

	function continueAuto()
	{
		$('.autoUpdate').hide();
		$('.updateNow').html('Cập nhật tự động');
	}

	function getMissedCallUser()
	{
		$.get('/auth/callcenter/log/getMissedCallUser', function(res){
			clearInterval(x);
			$('.divMissedCall').html(res.view);

			countdown = distance;
			$(".updateNow").html('Cập nhật: ' + countdown + ' s (Nhấn vào sẽ cập nhật ngay)');
			
			x = setInterval(function() {
			  countdown--;
			  $(".updateNow").html('Cập nhật:  ' + countdown + ' s (Nhấn vào sẽ cập nhật ngay)');

			  if (countdown <= 0) {
			    clearInterval(x);
			    console.log('clear x');
			    $(".updateNow").html('Cập nhật');
			  }
			}, 1000);
		});
	}
</script>
<script src="/admin/js/callcenter/jabberwerx.js"></script>
<script src="/admin/js/callcenter/finessenongadget.js"></script>
<script src="/admin/js/callcenter/initcallcenter.js"></script>
<script src="/admin/js/callcenter/callcenter.js"></script>
@endsection

@section('style')
@endsection