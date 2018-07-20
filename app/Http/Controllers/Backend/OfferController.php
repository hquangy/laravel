<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;

class OfferController extends Controller
{
    protected $message_errors = [
        'title.required'             => 'Tựa đề không được để trống',
        'title.min'                  => 'Tựa đề trên :min ký tự',
        'en_title.required'          => 'Tựa đề (en) không được để trống',
        'en_title.min'               => 'Tựa đề (en) trên :min ký tự',
        'slug.required'              => 'Slug không được để trống',
        'slug.min'                   => 'Slug trên :min ký tự',
        'slug.max'                   => 'Slug không quá :max ký tự',
        'slug.unique'                => 'Slug đã tồn tại',
        'short_description.required' => 'Mô tả ngắn không được để trống',
        'short_description.min'      => 'Mô tả ngắn trên :min ký tự',
        'short_description.min'      => 'Mô tả ngắn không quá :max ký tự',
        'content.required'           => 'Mô tả không được để trống',
        'content.min'                => 'Mô tả trên :min ký tự',
        'city.required'              => 'Thành phố không được để trống',
        'district.required'          => 'Thành phố không được để trống',
        'filename.required'          => 'Hình ảnh không được để trống',
    ];

    protected $storeValidate = [
        'title' => 'bail|min:6|max:190',
        'slug' => 'required|max:190|unique:offers,slug',
        'short_description' => 'nullable|max:190',
        'filename' => 'required',
    ];

    protected $updateValidate = [];

    protected $model;

    // list cities
    protected $cities = [];

    // list districts
    protected $districts= [];
    protected $title = 'Ưu đãi';
    protected $pre_view = 'backend.offer.';

    public function __construct()
    {
        $this->model = new Offer();
        $this->updateValidate = $this->storeValidate;
        $this->updateValidate['filename'] = 'nullable';

        $this->middleware(function ($request, $next) {
            view()->share('title', $this->title);
            view()->share('pre_view', $this->pre_view);
            return $next($request);
        });
    }

    public function index()
    {
    	$items = $this->model->full()->get();
    	return view($this->pre_view.'index',compact('items'));
    }

    public function create()
    {
        // $this->cities = Region::listAllCities();
        // $this->districts = Region::listAllDistricts();
    	foreach($this->model->defaultFields() as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	return view($this->pre_view.'create',[
            'data' =>$data, 
            // 'cities' => $this->cities,
            // 'districts' => $this->districts,
        ]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, $this->storeValidate, $this->message_errors);

        $this->model->storeObj($request);

        return redirect()->route($this->pre_view.'create')
        ->withSuccess('Đã tạo thành công '.  $this->model->title);
    }

    public function edit($id)
    {
        $this->model = $this->model->findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->model->defaultFields()) as $field){
            $data[$field] = old($field, $this->model->$field);
        }
        // $this->cities = Region::listAllCities();
        // $this->districts = Region::listAllDistricts($this->model->city);

        return view($this->pre_view.'edit',[
            'data' =>$data,
            'model' => $this->model,
            // 'cities' => $this->cities,
            // 'districts' => $this->districts,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->updateValidate['slug'] = $this->updateValidate['slug'] .','.$id;
        $this->validate($request, $this->updateValidate, $this->message_errors);
        
        $this->model = $this->model->findOrFail($id);

        $this->model->updateObj($request);
    
        return redirect()->route($this->pre_view.'edit', ['id' => $this->model->id])
        ->withSuccess($this->model->title.' lưu thành công');
    }

    public function destroy($id)
    {
        $this->model = $this->model->findOrFail($id);
        $title = $this->model->title;
        $this->model->delete();
        return redirect()->route($this->pre_view.'index')
        ->withSuccess($title .' đã xóa thành công');
    }

    public function excelUpload(Request $request)
    {
        $file = $request->file('filename');
        $this->model->uploadExcel($file);
        return redirect()->route($this->pre_view.'index')
        ->withSuccess('Upload thành công');
    }
}
