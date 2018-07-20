<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\ExcelSupport;
use App\Services\Upload;
use DB;

class Offer extends Model
{
	use SoftDeletes;
    protected $table = 'offers';
	protected $fillable = [
		'order',
		'boost',
		'visibility',
		'is_hot',

		'title',
		'en_title',
		'meta_title',
		'facebook_title',
		'sub_title',
		'slug',
		'short_description',

		'filename',
		'description',
		'content',
		'meta_description',
		'facebook_description',

		'expires_at',
	];

    protected $fields_expect = [
        'filename', 'image'
    ];

    protected $appends = ['link'];

	# start relationship
    # morphTo
    // For Model Message
    // public function messagable()
    // {
    //     return $this->morphTo();
    // }
    // For Model Offer
    // public function messages()
    // {
    //     return $this->morphMany('App\Message', 'messagable');
    // }

    # end relationship

    public function getLinkAttribute()
    {
        return url('uu-dai') . '/' . $this->slug . '-' . $this->id . '.html';
    }

    public function getImageSmallAttribute()
    {
        if(!$this->filename) return null;
        $path_parts = pathinfo($this->filename);
        return $path_parts['dirname'] . '/small/' .$path_parts['filename'] . '.' .$path_parts['extension'];
        // echo $path_parts['dirname'], "\n";
        // echo $path_parts['basename'], "\n";
        // echo $path_parts['extension'], "\n";
        // echo $path_parts['filename'], "\n"; // since PHP 5.2.0
    }

    public function getImageMediumAttribute()
    {
        if(!$this->filename) return null;
        $path_parts = pathinfo($this->filename);
        return $path_parts['dirname'] . '/medium/' .$path_parts['filename'] . '.' .$path_parts['extension'];
    }

    public function getImageLargeAttribute()
    {
        if(!$this->filename) return null;
        $path_parts = pathinfo($this->filename);
        return $path_parts['dirname'] . '/large/' .$path_parts['filename'] . '.' .$path_parts['extension'];
    }


    public function checkLink($url_request)
    {
        if(!$this->slug) return false;

        $pattern = '/[a-zA-Z0-9]+\.(html)$/i';

        // check html cuối
        if(!preg_match($pattern, $url_request['full'])){
            return false;
        }

        // check slug item
        if($this->slug != $url_request['slug']){
            return false;
        }

        return true;
    }

    /**
    * Make default fields
    *
    * @param null
    */
    public function scopeDefaultFields($query)
    {
        $fields = [];
        foreach($this->fillable as $attribue){
            $fields[$attribue] = null; 
        }
        $fields['visibility'] = 1;
        return $fields;
    }

    public static function uploadExcel($file)
    {
    	//try catch
    	$path = ExcelSupport::uploadFile($file);
    	$objects = ExcelSupport::excelToPhp($path);

    	foreach($objects as $object){
    		if(!$object->id) return null;
    		$product = Product::find($object->id);
    		if(!$product) $product = new Product;
    		$product->id = $object->id;
    		$product->title = $object->title;
    		$product->price_min = $object->price_min * 1000;
    		$product->price_max = $object->price_max *1000;
    		$product->category_id = $object->category_id;
    		$product->user_id = 1;
    		$product->slug = str_slug($object->title);
    		$product->save();
    	}
    }

    public function scopeStoreObj($query, $request)
    {
        $new_array = array_diff($this->fillable, $this->fields_expect);
        foreach($new_array as $field){
            $this->$field = $request->get($field);
        }

        $this->uploadImage($request->file('filename'));
        
        $this->save();
    }

    public function scopeUpdateObj($query, $request)
    {
        $new_array = array_diff($this->fillable, $this->fields_expect);
        foreach($new_array as $field){
            $this->$field = $request->get($field);
        }

        $this->uploadImage($request->file('filename'));

        $this->save();
    }

    public function uploadImage($file, $folder = null)
    {
        if(!$file) return null;

    	$folder = $folder ? $folder : 'uploads';
        $this->slug = $this->slug ? $this->slug : str_slug($this->title);
    	$filename = $this->slug . '-'.rand(0,9999);
        $this->filename = Upload::uploadFile($file, $folder, $filename);
    }

    // full with trash
    public function scopeFullWithTrashed($query)
    {
    	$query
        ->withTrashed()
        ->defaultOrder();
    }

    public function scopeFull($query)
    {
        $query->defaultOrder();
    }

    public function scopeVisibility($query)
    {
        $query->where('visibility',1)->defaultOrder();
    }

    public function scopeRelationModel($query)
    {
        $query->with(['something']);
    }

    public function scopeDefaultOrder($query)
    {
        // order NULL values last
        // $query->select(['*', DB::raw('IF(`order` IS NOT NULL, `order`, 100000) `order`')])
        // ->orderBy('order', 'asc');

        // ưu tiên order, boost
        $query->select(['*', \DB::raw('IF(`order` IS NOT NULL AND `order` != 0, `order`, IF(`boost` IS NOT NULL AND `boost` != 0, `boost`+1000, 100000)) `boost`')])
        ->orderBy('boost')
        ->orderBy('updated_at','desc');
    }

    /**
    * Set the title attribute and automatically the slug
    *
    * @param string $value
    */
    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     if (! $this->exists) {
    //         $this->setUniqueSlug($value, '');
    //         // $this->attributes['slug'] = str_slug($value);
    //     }
    // }

    /**
    * Recursive routine to set a unique slug
    *
    * @param string $title
    * @param mixed $extra
    */
    // protected function setUniqueSlug($title, $extra)
    // {
    //     $slug = str_slug($title.'-'.$extra);
    //     if (self::whereSlug($slug)->exists()) {
    //         $this->setUniqueSlug($title, $extra + 1);
    //         return;
    //     }

    //     $this->attributes['slug'] = $slug;
    // }

}
