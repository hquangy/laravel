<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductWatch;

use Carbon\Carbon;
use App\Services\ExcelSupport;
use Validator;

class ExcelController extends Controller
{
	public $ProductWatch;

	public function __construct()
	{
	    $this->ProductWatch = new ProductWatch;
	    // $this->WinPrize = new WinPrize;
	    // $this->VourcherCode = new VourcherCode;
	    // $this->fields = $this->VongXoay->renderItems();

	    // $this->middleware(function ($request, $next){
	    //     view()->share('pre_view', $this->pre_view);
	    //     view()->share('pre_route', $this->pre_route);
	    //     view()->share('pre_temp', $this->pre_temp);
	    //     view()->share('title', $this->title);
	    //     view()->share('fields', $this->fields);

	    //     return $next($request);
	    // });
	}

	public function excelFace()
	{

		$products = $this->ProductWatch::query();

		// $products->where('nstatus', 1);
		// $products->where('nid', 325090);
		// $products->relationModel()->orderBy('nid');
		// $product = $products->first();
		// dd($product->material);



    	$products = $this->ProductWatch::query();

    	$products->where('nstatus', 1);
    	// $products->where('nid', 315223);
    	$products = $products->relationModel()->orderBy('nid');
    	// $products = $products->take(10)->get();

    	// dd($products->first()->type);
    	// $count = $query->count();
    	// dd($count);

    	$excel = null;

		// foreach($products as $product){
		// 	if( !$product->cproducts_vni) continue;

		// 	$excel[] = [
		// 		'id' => $product->nid,
		// 		// 'ID2' => '',
		// 		'title' => strip_tags($product->cproducts_vni),
		// 		'description' => strip_tags( $product->description_ex ),
		// 		'availability' => $product->store_status,
		// 		'condition' => 'new',
		// 		'price' => $product->price,
		// 		'link' => $product->link,
		// 		'image_link' => $product->pri_img,
		// 		'brand' => optional($product->category)->ccat_products_vni,
		// 		'additional_image_link' => $product->sec_img,
		// 		'color' => $product->color,
		// 		'gender' => $product->gender,
		// 		'sale_price' => $product->price_off,
		// 		'google_product_category' => 'Apparel & Accessories > Jewelry > Watches (201)',

		// 		// 'Final URL' => str_replace('.', '%2C',$product->link),
		// 		// 'Image URL' => str_replace('.', '%2C',$product->pri_img),
		// 		// 'Item subtitle' => '',
		// 		// 'Item category' => 'Apparel & Accessories > Jewelry > Watches (201)',
		// 		// 'Price' => $product->price,
		// 		// 'Sale price' => $product->price_off,
		// 		// 'Contextual keywords' => '',
		// 		// 'Item address' => '',
		// 		// 'Tracking template' => '',
		// 		// 'Custom parameter' =>'',
		// 		// 'Final mobile URL' => str_replace('.', '%2C',$product->link),
		// 	];
		// }

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni) continue;

					$excel[] = [
						'id' => $product->nid,
						// 'ID2' => '',
						'title' => strip_tags($product->cproducts_vni),
						'description' => strip_tags( $product->description_ex ),
						'availability' => $product->store_status,
						'condition' => 'new',
						'price' => $product->price,
						'link' => $product->link,
						'image_link' => $product->pri_img,
						'brand' => optional($product->category)->ccat_products_vni,
						'additional_image_link' => $product->sec_img,
						'color' => $product->color,
						'gender' => $product->gender,
						'sale_price' => $product->price_off,
						'google_product_category' => 'Apparel & Accessories > Jewelry > Watches (201)',

					];
    		}

    	});

    	$excel_name = 'Facebook_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export','csv');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.csv';
    	ob_end_clean();
    	return response()->download($pathToFile);

	}

    public function excelGoogleMerchant()
    {
    	// $items = $this->ProductWatch->where('nstatus', 1)->relationModel()->get();
    	$products = $this->ProductWatch::query();

    	$products->where('nstatus', 1);
    	// $products->where('nid', 315223);
    	$products = $products->relationModel()->orderBy('nid');
    	// $products = $products->take(10)->get();

    	// dd($products->first()->type);
    	// $count = $query->count();
    	// dd($count);

    	$excel = null;

		// foreach($products as $product){
		// 	if( !$product->cproducts_vni) continue;

		// 	$excel[] = [
		// 		'ID' => $product->nid,
		// 		// 'ID2' => '',
		// 		'Item title' => strip_tags($product->cproducts_vni),
		// 		'Final URL' => str_replace('.', '%2C',$product->link),
		// 		'Image URL' => str_replace('.', '%2C',$product->pri_img),
		// 		'Item subtitle' => '',
		// 		'Item description' => strip_tags($product->description_ex),
		// 		'Item category' => 'Apparel & Accessories > Jewelry > Watches (201)',
		// 		'Price' => $product->price,
		// 		'Sale price' => $product->price_off,
		// 		'Contextual keywords' => '',
		// 		'Item address' => '',
		// 		'Tracking template' => '',
		// 		'Custom parameter' =>'',
		// 		'Final mobile URL' => str_replace('.', '%2C',$product->link),
		// 	];
		// }

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni or !$product->price ) continue;

					$excel[] = [
						'ID' => $product->nid,
						// 'ID2' => '',
						'Item title' => strip_tags($product->cproducts_vni),
						'Final URL' => str_replace('.', '%2C',$product->link),
						'Image URL' => str_replace('.', '%2C',$product->pri_img),
						'Item subtitle' => '',
						'Item description' => strip_tags($product->description_ex),
						'Item category' => 'Apparel & Accessories > Jewelry > Watches (201)',
						'Price' => $product->price,
						'Sale price' => $product->price_off,
						'Contextual keywords' => '',
						'Item address' => '',
						'Tracking template' => '',
						'Custom parameter' =>'',
						'Final mobile URL' => str_replace('.', '%2C',$product->link),
					];
    		}

    	});

    	$excel_name = 'Google_Merchant_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.xlsx';
    	ob_end_clean();
    	return response()->file($pathToFile);
    }
}
