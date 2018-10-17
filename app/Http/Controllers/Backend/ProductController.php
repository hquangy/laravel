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
    // model
    private $Product;

    // variables common
    protected $title = 'Sản phẩm';
    protected $view = 'backend.product.';
    protected $route = 'backend.product.';

    protected $operators = [
        'like' => 'LIKE',
        'equal' => '=',
        'not_equal' => '<>',
        'less_than' => '<',
        'greater_than' => '>',
        'less_than_or_equal_to' => '<=',
        'greater_than_or_equal_to' => '>=',
        'in' => 'IN',
    ];

    // data
    protected $data = [
        'id' => [
            'col_table' => 1,
            'desc' => 'ID',
            'col_order' => true,
            'col_filter' => 1,
        ],

        'title' => [
            'col_table' => 2,
            'desc' => 'Tên',
            'col_filter_select' => true,
            'col_order' => true,
            'col_filter' => 2,
        ],

        'order' => [
            'col_table' => 3,
            'desc' => 'Thứ tự',
            'col_order' => true,
            'col_filter' => 3,
        ],

        'visibility' => [
            'col_table' => 4,
            'desc' => 'Ẩn/Hiện',
            'col_order' => true,
        ],

        'slug' => [
            'col_table' => 5,
            'desc' => 'Slug',
            'col_order' => true,
            'col_filter' => 5,
        ],

        'short_description' => [
            'col_table' => 6,
            'desc' => 'Mô tả ngắn',
            'col_order' => true,
            'col_filter' => 6,
        ],

        'filename' => [
            'col_table' => 7,
            'desc' => 'Hình chính',
            'col_filter' => 7,
        ],

        'created_at' => [
            'desc' => 'Ngày tạo',
            'time' => true,
        ],
    ];

    public function __construct()
    {
        // model contructor
        $this->Product = new Product();

        $this->middleware(function ($request, $next) {
            view()->share('title', $this->title);
            view()->share('view', $this->view);
            view()->share('route', $this->route);
            view()->share('data', $this->data);
            view()->share('operators', $this->operators);
            return $next($request);
        });
    }

    public function index()
    {
        $request = request();
        $items = $this->filter('Product', $request);

        if($request->ajax()){
            
            // for excel
            if($request->export == 'excel'){
                foreach ($items as $item) {
                    $excel[] = [
                        'ID' => $item->id,
                        'Inside' => $item->inside_code,
                        'Email' =>  optional($item->user)->email,
                        'Từ số' => $item->from_phone,
                        'Đến số' => $item->to_phone,
                        'Mã cuộc gọi' => $item->call_id,
                        'Loại cuộc gọi' => strip_tags($item->type_call),
                        'Trạng thái' => $item->state,
                        'Link download ghi âm' => $item->link_download,
                        'Ngày tạo' => date_ft_full($item->created_at),
                    ];
                }

                $excel_name = 'Excel_CallItem_' . $request->user()->id;
                $data = ExcelSupport::store($excel, $excel_name, false, 'export');

                return response([
                    'code' => 1,
                    'link' => url('/') . '/upload/export/' . $excel_name . '.xlsx',
                    'message' => 'Xuất dữ liệu thành công nhấn vào <a href="/upload/export/' . $excel_name . '.xlsx">tải về</a>',
                ],200);
            }

            // for normal
            return response([
                'view' => view($this->view.'.partials.table',compact('items'))->render(),
            ],200);

        } //end $request->ajax()

    	return view($this->view.'index',compact('items'));
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
        $this->validate($request, [
            'fileExcelImport' => 'required|mimes:xls,xlsx|max:5120',
        ]);

        $file = $request->file('fileExcelImport');

        $path = $this->Product->uploadExcel($file);

        return redirect()->route($this->route.'index')->withSuccess('Import file excel thành công');

        // return response([
        //     'code' => '200',
        //     'message' => 'Import file excel thành công',
        //     'path' => $path,
        // ], 200);
    }

    // my filter
    private function filter($object, $request)
    {
        $object = "App\\$object";
        $class = new $object;
        $query = $class::query();

        // for search
        if($request->search){
            $query->where($request->col,'LIKE', '%'.$request->search.'%');
        }
        
        foreach(array_keys($this->data) as $header){
            // not time
            if($request->$header && !isset($this->data[$header]['time'])){
                if($this->data[$header]['defaul_operator'] == 'LIKE'){
                    $request->$header = '%'.$request->$header.'%';
                }

                if($request->$header == -1){
                    $request->$header = null;
                }

                $query->where($header, $this->data[$header]['defaul_operator'], $request->$header);
            }

            // time
            if($request->$header && isset($this->data[$header]['time'])){
                if ($request->$header) {
                    $ngay_tao_range = explode('-', $request->$header);
                    foreach ($ngay_tao_range as $key => $item) {
                        $ngay_tao_range[$key] = Carbon::createFromFormat('d/m/Y', trim($item));
                    }
                    $query->whereBetween($header, array($ngay_tao_range[0]->setTime(0, 0, 0), $ngay_tao_range[1]->addDay()->setTime(0, 0, 0)));
                }
            }
        }

        // for order by
        if ($request->orderBy) {
            // order by something
        }else{
            $query->orderBy('created_at','desc');
        }

        // for export
        if($request->export == 'excel'){
            return $query->relationModel()->get();
        }

        $request->rowPerPage = in_array($request->rowPerPage, [10,20,30,40]) ? $request->rowPerPage : 10;

        // for normal
        return $query->relationModel()->paginate($request->rowPerPage);
    }

    private function renderTableHtml($items)
    {
        return $items->map(function ($item) {
            return $this->transformTableHtml($item);
        });
    }

    private function transformTableHtml($item)
    {
        return 
        "<tr>".
        "<td>$item->id</td>".
        "<td>$item->title</td>".
        "<td>$item->order</td>".
        "<td>$item->visibility</td>".
        "<td>$item->slug</td>".
        "<td>$item->short_description</td>".
        "<td>$item->filename</td>".
        "<td>$item->date_ft_full($item->created_at)</td>".
        "</tr>"
        ;
        // return [
        //     'id' => $item->id,
        //     'title' => $item->title,
        //     'order' => $item->order,
        //     'visibility' => $item->visibility,
        //     'slug' => $item->slug,
        //     'short_description' => $item->short_description,
        //     'filename' => $item->filename,
        //     'created_at' => date_ft_full($item->filename),
        // ];
    }
}
