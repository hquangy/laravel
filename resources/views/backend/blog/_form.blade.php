<div class="box-body">


	<div id="home" class="tab-pane fade in active">
		<p></p>
		<div class="col-sm-8">

			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Tựa đề</label>
				<input type="text" class="form-control title-seo" id="title" name="title" value="{{ $data['title'] }}">
				@if ($errors->has('title'))
				    <span class="help-block">
				        <strong>{{ $errors->first('title') }}</strong>
				    </span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
				<label for="slug">Slug</label>
				<input type="text" class="form-control" id="slug" name="slug" value="{{ $data['slug']}}">
				@if ($errors->has('slug'))
				    <span class="help-block">
				        <strong>{{ $errors->first('slug') }}</strong>
				    </span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('boost') ? ' has-error' : '' }}">
			  <label for="boost">Ưu tiên (từ 1->10)</label>
			  <select name="boost" id="inputOrder" class="form-control">
			  	<option value="">Chọn thứ tự</option>
			  	@foreach(range(1,10) as $i)
			  		<option value="{{ $i }}" @if($data['boost'] == $i) selected="selected" @endif>{{ $i }}</option>
			  	@endforeach
			  </select>
			  @if ($errors->has('boost'))
			      <span class="help-block">
			          <strong>{{ $errors->first('boost') }}</strong>
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

			<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
				<label for="content">Nội dung</label>
				<textarea name="content" class="form-control" id="content" rows="3">{{ $data['content'] }}</textarea>
				@if ($errors->has('content'))
				    <span class="help-block">
				        <strong>{{ $errors->first('content') }}</strong>
				    </span>
				@endif
			</div>
		</div>

		<div class="col-sm-4">
			<label for="visibility">Hiện\Ẩn</label>
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

			{{-- start image --}}
			@if($mode == 'edit')
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
			</div>
			{{-- end image --}}
		</div>
	</div>{{-- end tab #home --}}
</div>
{{-- /.box-body --}}
@section('script')
<script src="/ckeditor/ckeditor.js"></script>
<script>
$(document).ready(function(){
	$('#title').on('keyup',function (e){
		$('#slug').val(slugify($('#title').val()));
	});

	CKEDITOR.replace( 'content');
});
</script>
@endsection