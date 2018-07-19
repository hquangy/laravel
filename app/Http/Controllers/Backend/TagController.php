<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    protected $fields = [
    	'title' => '',
    	'slug' => '',
    	'subtitle' => '',
    	'description' => '',
    	'meta_description' => '',
    	'image' => '',
        'page_image' => '',
        'layout' => '',
    	'direction' => '',
    ];
    
    protected $link = 'auth/tag/';
    protected $view = 'backend.tag.';
    protected $title = 'Tag';
    
    public function index(Request $request)
    {
    	$data = Tag::all();
        return view($this->view.'index',
    	[
    	    'title' => 'Danh sách '. $this->title,
    	    'breadcrumbs'=> [
    	        [
    	            'title' => 'Danh sách '. $this->title, 'route' => url($this->link)
    	        ],
    	    ],
    	    'data' => $data,
            'permission' => [
                'list' => null,
                'create' => null,
                'edit' =>  null,
                'delete' => null,
            ]
    	]);
    }
    
    public function create()
    {
    	foreach($this->fields as $field => $default){
    		$data[$field] = old($field,$default);
    	}
    
        return view($this->view. 'create',
        	[
        	    'title' => 'Tạo '.$this->title,
        	    'breadcrumbs'=> [
        	        [
        	            'title' =>'Tạo '.$this->title, 'route' => url($this->link .'create')
        	        ],
        	    ],
        	    'data' => $data,
        	    'permission' => [
        	        'list' => null,
        	        'create' => null,
        	        'edit' =>  null,
        	        'delete' => null,
        	    ]
        	]
        );
    }
    
    public function store(Request $request)
    {
    	$this->validate($request, [
    	    'title' => 'required|unique:group_loais,title',
    	    'slug' => 'required|unique:group_loais,slug',
    	    'order' => 'required',
    	    'filename' => 'nullable|mimes:jpeg,jpg,png|image|max:2048',
    	]);
    
    	// save model
    	$tag = new Tag();
    	foreach(array_keys(array_except($this->fields,['filename'])) as $field){
    	    $tag->$field = $request->get($field);
    	}
    
    	$tag->save();
    
    	return redirect($this->link_create)
    	->withSuccess('Tạo thành công');
    
    }
    
    public function edit(Request $request, $id)
    {
    	$tag = Tag::findOrFail($id);
    	$data = ['id' => $id];
    	foreach(array_keys($this->fields) as $field){
    		$data[$field] = old($field,$tag->$field);
    	}
    
        return view($this->view.'edit',
    		[
    		    'title' => 'Chỉnh sửa ' .$this->title,
    		    'breadcrumbs'=> [
    		        [
    		            'title' => 'Chỉnh sửa ' .$this->title, 'route' => url($this->link .'edit')
    		        ],
    		    ],
    		    'data' => $data,
                'permission' => [
                    'list' => null,
                    'create' => null,
                    'edit' =>  null,
                    'delete' => null,
                ]
    		]
        );
    }
    
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    	    'title' => 'required|unique:group_loais,title,'.$id,
    	    'slug' => 'required|unique:group_loais,slug,'.$id,
    	    'order' => 'required',
    	    'filename' => 'nullable|mimes:jpeg,jpg,png|image|max:2048',
    	]);
    
    	$tag = Tag::findOrFail($id);
    	foreach(array_keys(array_except($this->fields,['filename'])) as $field){
    	    $tag->$field = $request->get($field);
    	}
    
    	return redirect($this->link . 'edit/' .$tag->id)
    	->withSuccess('Lưu thành công');
    }
    
    public function destroy($id)
    {
    	$tag = Tag::findOrFail($id);
    
        // delete tag
        $tag->deleteFile();
    	$tag->delete();
    
    	return redirect($this->link)
    	->withSuccess('Xóa thành công');
    }
    
    public function api(Request $request)
    {
    
    }
    	
}
