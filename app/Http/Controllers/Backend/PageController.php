<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller
{
	protected $fields = [
	    'title' => '',
	    'slug' => '',
	    'order'=> '',
	    'boost'=> '',
	    'visibility'=> '',
	    'short_description'=> '',
	    'filename'=> '',
	    'description'=> '',
	    'content'=> '',

	    'face_title'=> '',
	    'face_description'=> '',

	    'meta_title'=> '',
	    'meta_description'=> '',
	    'expires_at'=>'',
	];

    public function index()
    {
    	$pages = Page::all();
    	return view('backend.page.index',[
    		'pages' => $pages,
    	]);
    }

    public function create()
    {
    	foreach($this->fields as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	return view('backend.page.create',[
    		'data' => $data
    	]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:6',
            'slug' => 'required|min:6|unique:blogs,slug',
            'short_description' => 'required|min:6|max:190',
            'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],[
            'title.required' => 'Tựa đề không được để trống',
            'title.min' => 'Tựa đề trên :min ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.min' => 'Slug trên :min ký tự',
            'slug.unique' => 'Slug đã tồn tại',
            'short_description.required' => 'Mô tả ngắn không được để trống',
            'short_description.min' => 'Mô tả ngắn trên :min ký tự',
            'short_description.min' => 'Mô tả ngắn không quá :max ký tự',
            'content.required' => 'Mô tả không được để trống',
            'content.min' => 'Mô tả trên :min ký tự',
        ]);
        
        $blog = new Page();

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $blog->$field = $request->get($field);
        }

        $blog->save();

        return redirect()->route('backend.page.index')
        ->withSuccess('Đã tạo thành công');
    }

    public function edit($id)
    {
        $blog = Page::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field,$blog->$field);
        }

        return view('backend.page.edit',
            [
                'data' => $data,
            ]
        );

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:6',
            'slug' => 'required|min:6|unique:blogs,slug,'.$id,
            'short_description' => 'required|min:6|max:190',
            'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],[
            'title.required' => 'Tựa đề không được để trống',
            'title.min' => 'Tựa đề trên :min ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.min' => 'Slug trên :min ký tự',
            'slug.unique' => 'Slug đã tồn tại',
            'short_description.required' => 'Mô tả ngắn không được để trống',
            'short_description.min' => 'Mô tả ngắn trên :min ký tự',
            'short_description.min' => 'Mô tả ngắn không quá :max ký tự',
            'content.required' => 'Mô tả không được để trống',
            'content.min' => 'Mô tả trên :min ký tự',
        ]);
        
        $blog = Page::findOrFail($id);

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $blog->$field = $request->get($field);
        }

        if($request->file('filename')){
            $blog->filename = $blog->uploadImage($request->file('filename'));
        }

        $blog->save();
        
        return redirect()->route('backend.page.edit', ['id' => $blog->id])
        ->withSuccess('Lưu thành công');
    }

    public function destroy($id)
    {
        $blog = Page::findOrFail($id);
        $blog->delete();
        return redirect()->route('backend.page.index')
        ->withSuccess('Xóa thành công');
    }
}
