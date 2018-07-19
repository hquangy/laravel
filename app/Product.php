<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\ExcelSupport;

class Product extends Model
{
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
    		$product->en_title = str_replace("Bbq","BBQ",mb_ucwords($object->en_title));
    		$product->price_min = $object->price_min * 1000;
    		$product->price_max = $object->price_max *1000;
    		$product->category_id = $object->category_id;
    		$product->user_id = 1;
    		$product->slug = str_slug($object->title);
    		$product->save();
    	}
    }
}
