<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{   
	use SoftDeletes;

	protected $table = 'posts';

	protected $fillable = [
		'is_trash',
		'is_hot',
		'category_id',
		'user_id',
		'boost',
		'order',
		'visibility',
		'title',
		'slug',
		'subtitle',
		'facebook_title',
		'meta_title',
		'content',
		'description',
		'short_description',
		'filename',
		'raw',
		'facebook_description',
		'meta_description',
		'facebook_image',
		'published_at',
		'created_at',
		'updated_at',
	];

	protected $dates = ['deleted_at'];

	
	protected function mapData($item = null)
	{
		return $data = [
			'id'         => ['title' => 'ID', 'filter'=> 1, 'order' => 1 , 'data'=> optional($item)->id ],
			'visibility' => ['title' => 'Ẩn hiện', 'filter'=> 1, 'order' => 1, 'data'=> optional($item)->visibility],
			'content'    => ['title' => 'Nội dung', 'filter'=> 1, 'order' => 1, 'selected'=> 1,'data'=> optional($item)->content ],
			'created_at' => ['title' => 'Ngày tạo', 'filter'=> 1, 'order' => 1, 'datetime' => 1, 'data'=> date_ft_full(optional($item)->created_at)],
		];
	}

	public function scopeRenderItems($query, $items = null)
	{
		$fields = array_combine($this->fillable, array_keys($this->fillable));

		if( !$items ) return array_merge_recursive($this->mapData(), $fields);

		$result = [];

		foreach($items as $item){
			$result[$item->id] = array_merge_recursive( $this->mapData($item), $fields );
		}

		return $result;
	}

    // relationModel()
	public function scopeRelationModel($query)
	{
        // $query->with(['beThanhPho','beQuan']);
	}

    // defaultOrder()
	public function scopeDefaultOrder($query)
	{
        // order NULL values last
        // $query->select(['*', DB::raw('IF(`order` IS NOT NULL, `order`, 100000) `order`')])
        // ->orderBy('order', 'asc');

        // ưu tiên order, boost
        // $query->select(['*', \DB::raw('IF(`order` IS NOT NULL AND `order` != 0, `order`, IF(`boost` IS NOT NULL AND `boost` != 0, `boost`+1000, 100000)) `boost`')])
        // ->orderBy('boost')
        // ->orderBy('updated_at','desc');
		$query->latest();
	}

	public function scopeVisibility($query)
	{
		$query->where('visibility', 1)->where('is_trash', 0);
	}

#section action
	public function scopeUpdate()
	{

	}

	public function scopeStore()
	{
		$request = request();
		$this->fields['meta_title'] = 'Nhà thuốc Long Châu tại '. $this->address;
		$this->fields['face_title'] = 'Nhà thuốc Long Châu tại '. $this->address;

		$this->fields['meta_description'] = $this->meta_title . ' ' . 'là một trong số nhà thuốc thuộc chuỗi Long Châu, hệ thống nhà thuốc lớn nhất thành phố, kinh doanh thuốc, dược phẩm, thực phẩm chức năng, hóa mỹ phẫm.';
		$this->fields['face_description'] = $this->meta_title . ' ' . 'là một trong số nhà thuốc thuộc chuỗi Long Châu, hệ thống nhà thuốc lớn nhất thành phố, kinh doanh thuốc, dược phẩm, thực phẩm chức năng, hóa mỹ phẫm.';
		$this->fields['short_description'] =  $this->meta_description;

		foreach (array_keys($this->fields) as $field) {
            // files
			if( in_array($field, array_keys($this->file_fields)) ){

				if($request->hasFile($field)){
					$this->$field = UploadFile::upload( $request->file($field), str_slug($request->name) , $this->file_fields[$field]['path'] );
				}
				continue;
			}

            // get default if $request->$field null
			if( !$request->$field){
				$this->$field = $this->fields[$field];
				continue;
			}

			$this->$field = $request->$field;
		}

		$this->save();

		self::clearCache();
	}
#end section action
}
