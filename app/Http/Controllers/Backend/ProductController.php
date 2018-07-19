<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Services\Upload;
use App\Services\ExcelSupport;

class ProductController extends Controller
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
	    // 'content'=> '',
	    'facebook_title'=> '',
	    'facebook_description'=> '',
	    'meta_title'=> '',
	    'meta_description'=> '',
	    'category_id' => '',
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
    	$products = Product::with('category')
        ->orderBy('id','desc')
        ->get();
    	return view('backend.product.index',compact('products'));
    }

    public function create()
    {
    	foreach($this->fields as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	$categories = Category::orderBy('order')->get();

    	return view('backend.product.create',compact('data','categories'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:6',
            'en_title' => 'required|min:6',
            'category_id' =>'required',
            // 'slug' => 'required|min:6|unique:products,slug',
            // 'short_description' => 'required|min:6|max:150',
            // 'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message_errors);
        $product = new Product();

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $product->$field = $request->get($field);
        }
        $product->slug = str_slug($request->slug);
        $product->user_id = 1;
        $product->save();

        return redirect()->route('backend.product.create')
        ->withSuccess('Đã tạo thành công '. $product->title);
    }

    public function edit($id)
    {
        $category = Product::findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field,$category->$field);
        }

        $categories = Category::orderBy('order')->get();
        return view('backend.product.edit',compact('data','categories'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:6',
            'en_title' => 'required|min:6',
            'category_id' =>'required',
            // 'slug' => 'required|min:6|unique:products,slug,'.$id,
            // 'short_description' => 'required|min:6|max:150',
            // 'content' => 'required|min:6',
            'filename' => 'nullable|image|mimes:jpeg,jpg,png|max:5120'
        ],$this->message_errors);
        
        $product = Product::findOrFail($id);

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $product->$field = $request->get($field);
        }
        // if($request->file('filename')){
        //     $category->filename = $category->uploadImage($request->file('filename'));
        // }
        $product->slug = str_slug($request->slug);
        $product->user_id = 1;
        $product->save();
        
        return redirect()->route('backend.product.edit', ['id' => $product->id])
        ->withSuccess('Lưu thành công');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('backend.product.index')
        ->withSuccess('Xóa thành công');
    }

    public function excelUpload(Request $request)
    {
        $file = $request->file('filename');
        Product::uploadExcel($file);
        return redirect()->route('backend.product.index')
        ->withSuccess('Upload thành công');
    }

    public function excelForm()
    {
        return view('backend.product.excelForm');
    }
}
