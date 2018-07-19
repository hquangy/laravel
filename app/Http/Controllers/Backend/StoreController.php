<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Region;

class StoreController extends Controller
{
	protected $fields = [
        'title'             => '',
        'phone'             => '',
        'city'              => '',
        'district'          => '',
        'email'             => '',
        'order'             => '',
        'boost'             => '',
        'visibility'        => '',
        'short_description' => '',
        'description'       => '',
    ];

    protected $message_errors = [
        'title.required'             => 'Tựa đề không được để trống',
        'title.min'                  => 'Tựa đề trên :min ký tự',
        'en_title.required'          => 'Tựa đề (en) không được để trống',
        'en_title.min'               => 'Tựa đề (en) trên :min ký tự',
        'slug.required'              => 'Slug không được để trống',
        'slug.min'                   => 'Slug trên :min ký tự',
        'slug.unique'                => 'Slug đã tồn tại',
        'short_description.required' => 'Mô tả ngắn không được để trống',
        'short_description.min'      => 'Mô tả ngắn trên :min ký tự',
        'short_description.min'      => 'Mô tả ngắn không quá :max ký tự',
        'content.required'           => 'Mô tả không được để trống',
        'content.min'                => 'Mô tả trên :min ký tự',
        'city.required' => 'Thành phố không được để trống',
        'district.required' => 'Thành phố không được để trống',
    ];

    protected $model;
    protected $cities = [];
    protected $districts= [];
    protected $title = 'Trang quản lý chi nhánh';
    protected $pre_view = 'backend.store.';

    public function __construct()
    {
        $this->model = new Store();
        $this->middleware(function ($request, $next) {
            view()->share('title', $this->title);
            view()->share('pre_view', $this->pre_view);
            view()->share('model', $this->model);
            return $next($request);
        });
    }

    public function index()
    {
    	$stores = $this->model->orderBy('updated_at','desc')->get();
    	return view($this->pre_view.'index',compact('stores'));
    }

    public function create()
    {
        $this->cities = Region::listAllCities();
    	foreach($this->fields as $field => $default){
    	    $data[$field] = old($field,$default);
    	}

    	return view($this->pre_view.'create',[
            'data' =>$data, 'cities' => $this->cities, 'districts' => $this->districts,
        ]);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|min:6',
            'city' =>'required',
            'district' =>'required',
        ],$this->message_errors);
        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $this->model->$field = $request->get($field);
        }
        $this->model->save();

        return redirect()->route($this->pre_view.'create')
        ->withSuccess('Đã tạo thành công '.  $this->model->title);
    }

    public function edit($id)
    {
        $this->model = $this->model->findOrFail($id);
        $data = ['id' => $id];
        foreach(array_keys($this->fields) as $field){
            $data[$field] = old($field, $this->model->$field);
        }
        $this->cities = Region::listAllCities();
        $this->districts = Region::listAllDistricts($this->model->city);

        return view($this->pre_view.'edit',[
            'data' =>$data, 
            'cities' => $this->cities,
            'districts' => $this->districts,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:6',
            'city' =>'required',
            'district' =>'required',
        ],$this->message_errors);
        $this->model = $this->model->findOrFail($id);

        foreach(array_keys(array_except($this->fields,['filename'])) as $field){
            $this->model->$field = $request->get($field);
        }
        $this->model->save();
        
        return redirect()->route($this->pre_view.'edit', ['id' => $this->model->id])
        ->withSuccess('Lưu thành công');
    }

    public function destroy($id)
    {
        $this->model = $this->model->findOrFail($id);
        $this->model->delete();
        return redirect()->route($this->pre_view.'index')
        ->withSuccess('Bạn đã xóa thành công');
    }
}