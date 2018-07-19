<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
	protected $fields = [
	    'title' => '',
	    'en_title' => '',
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
	];

    protected $message_errors = [
        'title.required' => 'Tựa đề không được để trống',
        'title.min' => 'Tựa đề trên :min ký tự',
        'en_title.required' => 'Tựa đề (en) không được để trống',
        'en_title.min' => 'Tựa đề (en) trên :min ký tự',
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
    	$categories = Category::all();
    	return view('backend.category.index',compact('categories'));
    }

    public function create()
    {
    	foreach($this->fields as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	return view('backend.category.create',[
    		'data' => $data
    	]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:6',
            'en_title' => 'required|min:6',
            'slug' => 'required|min:6|unique:categories,slug',
            // 'short_description' => 'required|min:6|max:150',
            // 'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message_errors);
        $category = new Category();

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $category->$field = $request->get($field);
        }
        $category->slug = str_slug($request->slug);
        $category->save();

        return redirect()->route('backend.category.create')
        ->withSuccess('Đã tạo thành công '. $category->title);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field,$category->$field);
        }

        return view('backend.category.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:6',
            'en_title' => 'required|min:6',
            'slug' => 'required|min:6|unique:categories,slug,'.$id,
            // 'short_description' => 'required|min:6|max:150',
            // 'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message_errors);
        
        $category = Category::findOrFail($id);

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $category->$field = $request->get($field);
        }

        // if($request->file('filename')){
        //     $category->filename = $category->uploadImage($request->file('filename'));
        // }

        $category->slug = str_slug($request->slug);
        $category->save();
        
        return redirect()->route('backend.category.edit', ['id' => $category->id])
        ->withSuccess('Lưu thành công');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('backend.category.index')
        ->withSuccess('Xóa thành công');
    }

    public function info()
    {
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            echo ' [OK] PHP version is newer than 5.4: '.phpversion();
        } else {
            echo ' [ERROR] Your PHP version is too old for CKFinder 3.x.';
        }
        
        if (!function_exists('gd_info')) {
            echo ' [ERROR] GD extension is NOT enabled.';
        } else {
            echo ' [OK] GD extension is enabled.';
        }
        
        if (!function_exists('finfo_file')) {
            echo ' [ERROR] Fileinfo extension is NOT enabled.';
        } else {
            echo ' [OK] Fileinfo extension is enabled.';
        }
    }
}
