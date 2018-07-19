<div class="box-body">
	<div class="row">
		<div class="col-sm-12">
			<a class="btn btn-default" href="{{ route('backend.product.index') }}">
				Danh sách
			</a>
			@if($mode == 'create')
				<button type="submit" class="btn btn-primary" value="finished">Tạo mới</button>
			@else
			<button type="submit" class="btn btn-success" name="action" value="finished">
				<i class="fa fa-floppy-o"></i>
				Cập nhật
			</button>
			
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
				<i class="fa fa-times-circle"></i>
				&nbsp;Xóa
			</button>
			@endif
		</div>
	</div>

	<div id="home" class="tab-pane fade in active">
		<p></p>
		<div class="col-sm-8">
			@if($mode == 'edit')
			<div class="form-group">
				<label for="title">ID </label>
				<input type="text" class="form-control" id="id" value="{{ $data['id'] }}" readonly="">
			</div>
			@endif

			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Tựa đề <span class="require">*</span></label>
				<input type="text" class="form-control title-seo" id="title" name="title" value="{{ $data['title'] }}" autofocus>
				@if ($errors->has('title'))
				    <span class="help-block">
				        <strong>{{ $errors->first('title') }}</strong>
				    </span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('en_title') ? ' has-error' : '' }}">
				<label for="en_title">Tựa đề (english) <span class="require">*</span></label>
				<input type="text" class="form-control" id="en_title" name="en_title" value="{{ $data['en_title'] }}">
				@if ($errors->has('en_title'))
				    <span class="help-block">
				        <strong>{{ $errors->first('en_title') }}</strong>
				    </span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
				<label for="categories">Danh mục</label>
				<select name="category_id" id="categories" class="form-control categories" placeholder="Chọn danh mục">
					<option value=""></option>
					@foreach ($categories as $category)
					<option value="{{ $category->id }}" @if($category->id == $data['category_id']) selected="selected" @endif>
						{{ $category->title }}
					</option>
					@endforeach
				</select>
				@if ($errors->has('category_id'))
				<span class="help-block">
					<strong>{{ $errors->first('category_id') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
				<label for="slug">Slug<span class="require">*</span></label>
				<input type="text" class="form-control" id="slug" name="slug" value="{{ $data['slug']}}">
				@if ($errors->has('slug'))
				    <span class="help-block">
				        <strong>{{ $errors->first('slug') }}</strong>
				    </span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('boost') ? ' has-error' : '' }}">
			  <label for="boost">Ưu tiên (từ 1->20)</label>
			  <select name="boost" id="inputOrder" class="form-control">
			  	<option value="">Chọn thứ tự</option>
			  	@foreach(range(1,20) as $i)
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

	var el = $("#title").get(0);
	var elemLen = el.value.length;
	el.selectionStart = elemLen;
	el.selectionEnd = elemLen;
	el.focus();

	$('.categories').selectize({
		plugins: ['remove_button','drag_drop'],
		sortField: 'text',
	});

	CKEDITOR.replace( 'content');
});
</script>
@endsection