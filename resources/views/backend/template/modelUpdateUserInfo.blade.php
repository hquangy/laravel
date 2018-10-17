<div class="modal fade" id="modalUpdateInside" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cập nhật thông tin Inside</h4>
			</div>

			<script>
				$("#modalUpdateInside").on('shown.bs.modal', function () {
					var el = $("#inside_code").get(0);
					var elemLen = el.value.length;
					el.selectionStart = elemLen;
					el.selectionEnd = elemLen;
					el.focus();
				});
			</script>

			<form method="POST" action="{{ route('auth.callcenter.updateInsideUserModal') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					
					<div class="form-group{{ $errors->has('inside_code') ? ' has-error' : '' }}">
					    <label for="inside_code">Mã inside</label>
					    <input type="text" class="form-control" id="inside_code" name="inside_code" value="{{ Auth::user()->inside_code }}">
					    @if ($errors->has('inside_code'))
					        <span class="help-block">
					            <strong>{{ $errors->first('inside_code') }}</strong>
					        </span>
					    @endif
					</div>

					<div class="form-group{{ $errors->has('inside_pass') ? ' has-error' : '' }}">
					    <label for="inside_pass">Mật khẩu inside</label>
					    <input type="password" class="form-control" id="inside_pass" name="inside_pass" value="{{ old('inside_pass')}}">
					    @if ($errors->has('inside_pass'))
					        <span class="help-block">
					            <strong>{{ $errors->first('inside_pass') }}</strong>
					        </span>
					    @endif
					</div>

					<div class="form-group{{ $errors->has('extensions') ? ' has-error' : '' }}">
					    <label for="extensions">Extensions</label>
					    <input type="text" class="form-control" id="extensions" name="extensions" value="{{ old('extensions') }}">
					    @if ($errors->has('extensions'))
					        <span class="help-block">
					            <strong>{{ $errors->first('extensions') }}</strong>
					        </span>
					    @endif
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật
					</button>
				</div>
			</form>
		</div>
	</div>
</div>