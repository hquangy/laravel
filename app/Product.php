<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\ExcelSupport;
use App\Services\Upload;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'is_hot',
        'is_index',
        'is_trash',
        'ancestor_category_id',
        'parent_category_id',
        'category_id',
        'user_id',
        'property_1',
        'property_2',
        'property_3',
        'boost',
        'order',
        'visibility',
        'price',
        'min_price',
        'max_price',
        'title',
        'en_title',
        'slug',
        'subtitle',
        'layout',
        'meta_title',
        'facebook_title',
        'description',
        'short_description',
        'meta_description',
        'facebook_description',
        'filename',
        'mobile_filename',
        'facebook_filename',
        'expires_at',
    ];

    protected $appends = ['link'];

    protected $fields_expect_file = [
        'filename', 'mobile_filename', 'facebook_filename'
    ];

	# start relationship
    public function category()
    {
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }
    # end relationship


    public function htmlPrice()
    {
    	if($this->price_min == $this->price_max){
        	// return number_format($this->price_min, 0, ',', '.') .' <u>₫</u>';
        	return number_format($this->price_min, 0, ',', '.');
    	}

    	return number_format($this->price_min, 0, ',', '.') .' - ' .number_format($this->price_max, 0, ',', '.');
    }

    public static function uploadExcel($file, $folder = null, $filename = null)
    {
        $folder = $folder ?? 'upload/' . date('Y') . '/' . date('m');
        $filename = $filename ?? 'import_excel_' . Auth::user()->id;

        $path = Upload::uploadFile($file, $folder, $filename);

        $items = ExcelSupport::excelToPhp($path);
        
        $object = new self;
        $new_array = array_diff($object->fillable, $object->fields_expect_file);
        try {
            foreach($items as $item){
                $object = new self;

                if(isset($item->id)){
                    $object->id = $item->id;
                }

                foreach($new_array as $field){
                    $object->$field = $item->$field;
                }

                $object->save();
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    // support function
    public function scopeRelationModel($query)
    {
        $query->with(['category']);
    }

    protected function uploadImage($file, $folder = null)
    {
        if(!$file) return false;

        $folder = $folder ?? 'upload';

        $this->slug = $this->slug ?? str_slug($this->title);
        $filename = $this->slug . '-'.rand(0,9999);

        $this->filename = Upload::uploadFile($file, $folder, $filename);
    }

    public function scopeDefaultOrder($query)
    {
        // order NULL values last
        // $query->select(['*', DB::raw('IF(`order` IS NOT NULL, `order`, 100000) `order`')])
        // ->orderBy('order', 'asc');

        // ưu tiên order >  boost > updated_at
        $query->select(['*', \DB::raw('IF(`order` IS NOT NULL AND `order` != 0, `order`, IF(`boost` IS NOT NULL AND `boost` != 0, `boost`+1000, 100000)) `boost`')])
        ->orderBy('boost')
        ->orderBy('updated_at','desc');
    }

}
