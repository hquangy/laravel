<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\ExcelSupport;

class Store extends Model
{
    public static function uploadExcel($file)
    {
    	//try catch
    	$path = ExcelSupport::uploadFile($file);
    	$objects = ExcelSupport::excelToPhp($path);
    	foreach($objects as $object){
    		if(!$object->id) return null;
    		$store = Store::find($object->id);
    		if(!$store) $store = new Store;
    		$store->id = $object->id;
    		$store->title = $object->title;
    		$store->phone = $object->phone;
    		$store->city = $object->city;
    		$store->visibility = 1;
    		$store->save();
    	}
    }
}