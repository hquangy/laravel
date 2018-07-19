<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;

class BlogController extends Controller
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

    protected $message = [
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
    ];

    public function index()
    {
    	$blogs = Blog::orderBy('boost')->get();
    	return view('backend.blog.index',[
    		'blogs' => $blogs,
    	]);
    }

    public function create()
    {
    	foreach($this->fields as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	return view('backend.blog.create',[
    		'data' => $data
    	]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:6',
            'slug' => 'required|min:6|unique:blogs,slug',
            'short_description' => 'required|min:6|max:250',
            'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message);
        
        $blog = new Blog();

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $blog->$field = $request->get($field);
        }
        $blog->uploadImage($request->file('filename'));
        $blog->save();

        return redirect()->route('backend.blog.index')
        ->withSuccess('Đã tạo thành công');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field,$blog->$field);
        }

        return view('backend.blog.edit',
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
            'short_description' => 'required|min:6|max:250',
            'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message);
        
        $blog = Blog::findOrFail($id);

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $blog->$field = $request->get($field);
        }
        $blog->uploadImage($request->file('filename'));
        $blog->save();
        
        return redirect()->route('backend.blog.edit', ['id' => $blog->id])
        ->withSuccess('Lưu thành công');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('backend.blog.index')
        ->withSuccess('Xóa thành công');
    }
}
