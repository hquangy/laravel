<div class="box-body">
	<div id="home" class="tab-pane fade in active">
		<p></p>
		<div class="col-sm-8">
			@if($mode == 'edit')
			<div class="form-group">
				<label for="title">ID </label>
				<input type="text" class="form-control" id="id" value="{{ $data['id'] }}" readonly>
			</div>
			@endif

			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Tựa đề <span class="text-danger">*</span></label>
				<input type="text" class="form-control title-seo" id="title" name="title" value="{{ $data['title'] }}" autofocus>
				@if ($errors->has('title'))
				    <span class="help-block">
				        <strong>{{ $errors->first('title') }}</strong>
				    </span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
				<label for="phone">Số điện thoại</label>
				<input type="text" class="form-control phone-seo" id="phone" name="phone" value="{{ $data['phone'] }}" autofocus>
				@if ($errors->has('phone'))
				    <span class="help-block">
				        <strong>{{ $errors->first('phone') }}</strong>
				    </span>
				@endif
			</div>
{{-- 
			<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
				<label for="slug">Slug<span class="require">*</span></label>
				<input type="text" class="form-control" id="slug" name="slug" value="{{ $data['slug']}}">
				@if ($errors->has('slug'))
				    <span class="help-block">
				        <strong>{{ $errors->first('slug') }}</strong>
				    </span>
				@endif
			</div>
			<script>
				$('#title').on('keyup',function (e){
					$('#slug').val(slugify($('#title').val()));
				});
			</script>
--}}
			<div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
			  <label for="order">Ưu tiên (từ 1->20)</label>
			  <select name="order" id="inputOrder" class="form-control">
			  	<option value="">Chọn thứ tự</option>
			  	@foreach(range(1,20) as $i)
			  		<option value="{{ $i }}" @if($data['order'] == $i) selected="selected" @endif>{{ $i }}</option>
			  	@endforeach
			  </select>
			  @if ($errors->has('order'))
			      <span class="help-block">
			          <strong>{{ $errors->first('order') }}</strong>
			      </span>
			  @endif
			</div>

			<div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
				<label for="short_description">Mô tả ngắn</label>
				<textarea name="short_description" class="form-control" id="short_description" rows="3">{{ $data['short_description'] }}</textarea>
				@if ($errors->has('short_description'))
				    <span class="help-block">
				        <strong>{{ $errors->first('short_description') }}</strong>
				    </span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<label for="description">Nội dung</label>
				<textarea name="description" class="form-control" id="description" rows="3">{{ $data['description'] }}</textarea>
				@if ($errors->has('description'))
				    <span class="help-block">
				        <strong>{{ $errors->first('description') }}</strong>
				    </span>
				@endif
			</div>
		</div>

		<div class="col-sm-4">
			{{-- Chọn city --}}
			<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
				<label for="cities">Thành phố<span class="text-danger">*</span></label>
				<select name="city" id="cities" class="form-control cities" placeholder="Chọn thành phố">
					<option value=""></option>
					@foreach ($cities as $city)
					<option value="{{ $city->id }}" @if($city->id == $data['city']) selected="selected" @endif>
						{{ $city->title }}
					</option>
					@endforeach
				</select>
				@if ($errors->has('city'))
				<span class="help-block">
					<strong>{{ $errors->first('city') }}</strong>
				</span>
				@endif
			</div>

			{{-- Chọn district --}}
			<div class="form-group divQuanHuyen">
				<label for="districts">Quận/Huyện<span class="text-danger">*</span></label>
				<select id="districts" name="district" class="form-control districts" placeholder="Tất cả các Quận Huyện">
					<option value="" selected="selected">
						Chọn thành phố trước
					</option>
					@foreach ($districts as $district)
					    <option value="{{ $district->id }}" @if($data['district'] and $district->id == $data['district']) selected="selected" @endif>
					       {{ $district->full_title }}
					    </option>
					@endforeach
				</select>
				@if ($errors->has('district'))
				<span class="help-block">
					<strong>{{ $errors->first('district') }}</strong>
				</span>
				@endif
			</div>
			<script>
				var xhr;
				var base_url_city = '/api/he-thong/listByCity/', base_url_district = '/api/stores-by-district/';
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
				    			url: '/api/all-districts/'+value,
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
				select_loai = $select_loai[0].selectize;
			</script>

			<label for="visibility">Hiện\Ẩn</label>
			@if($mode == 'create')
			<div class="form-group">
				<label class="radio-inline">
					<input type="radio" name="visibility" id="visibility" checked="checked" value="1">Hiện
				</label>
				<label class="radio-inline">
					<input type="radio" name="visibility" id="visibility" value="0">Ẩn
				</label>
			</div>
			@else
			<div class="form-group">
				<label class="radio-inline">
					<input type="radio" name="visibility" id="visibility"
						@if($data['visibility']) checked="checked" @endif
						value="1" 
					>Hiện
				</label>
				<label class="radio-inline">
					<input type="radio" name="visibility" id="visibility"
						@if(!$data['visibility']) checked="checked" @endif
						value="0" 
					>Ẩn
				</label>
			</div>
			@endif
			{{-- start image --}}
{{-- 			@if($mode == 'edit')
				<div class="row">
					<div class="col-sm-12">
						<img src="{{ $data['filename'] }}" class="img-rounded img-responsive">
					</div>
				</div>
			@endif

			<div class="form-group{{ $errors->has('filename') ? ' has-error' : '' }}">
				<label for="filename">Hình ảnh</label>
				<input type="file" class="form-control" name="filename" id="filename">
				@if ($errors->has('filename'))
				    <span class="help-block">
				        <strong>{{ $errors->first('filename') }}</strong>
				    </span>
				@endif
			</div> --}}
			{{-- end image --}}
		</div>
	</div>{{-- end tab #home --}}
</div>
{{-- /.box-body --}}
@section('script')
<script src="/ckeditor/ckeditor.js"></script>
<script>
$(document).ready(function(){
	// var el = $("#title").get(0);
	// var elemLen = el.value.length;
	// el.selectionStart = elemLen;
	// el.selectionEnd = elemLen;
	// el.focus();

	// $('.districts').selectize({
	// 	plugins: ['remove_button','drag_drop'],
	// 	sortField: 'text',
	// });

	CKEDITOR.replace('description');
});
</script>
@endsection