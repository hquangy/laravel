<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductWatch;
use App\CategoryWatch;

use Carbon\Carbon;
use App\Services\ExcelSupport;
use Validator;

class ExcelController extends Controller
{
	public $ProductWatch;
	public $CategoryWatch;

	public function __construct()
	{
	    $this->ProductWatch = new ProductWatch;
	    $this->CategoryWatch = new CategoryWatch;
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

    	$excel = null;


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
    	$products = $this->ProductWatch::query();

    	$products->where('nstatus', 1);

    	$products = $products->relationModel()->orderBy('nid');

    	$excel = null;

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

    public function excelTissot()
    {
    	$products = $this->ProductWatch::query();

    	$products->where('nstatus', 1)
    	->whereHas('category', function($query){
    		$query->where('ccode', '=', 'Tissot');
    	});
    	$products = $products->relationModel()->orderBy('nid');

    	$excel = null;

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni or !$product->price ) continue;

					$excel[] = [
						'ID' => $product->nid,
						'Item title' => strip_tags($product->cproducts_vni),
						'Final URL' => str_replace('.', '%2C',$product->link),
						'Type' => $product->storeStatus,
						'Category' => $product->category->ccode,
						'Sex' => $product->gender,
						'Price' => $product->price,
						'Sale price' => $product->price_off,
					];
    		}

    	});

    	$excel_name = 'Google_Merchant_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.xlsx';
    	ob_end_clean();
    	return response()->file($pathToFile);
    }

    public function excelByCategory()
    {

    	$products = $this->ProductWatch::query();

    	// $categories = $this->CategoryWatch->get();

    	// $i =1;
    	// foreach($categories as $category){
    	// 	echo  $i . ' ' . $category->ccat_products_vni . ' (' . $category->nid . ')<br>';
    	// 	$i++;
    	// }
    	// dd('ok');

    	/*
		Tissot 221
		Frederique Constant (310)
		Michael Kors (235)
		Swarovski (352)
		Gucci (260)
		Versace (318)
		Burberry (230)
		Movado (247)
		Salvatore Ferragamo (267)
		Longines (249)
    	*/
    	
    	$products->where('nstatus', 1)->whereIn('nid_cat_products',[221,310, 235, 352, 260, 318, 230, 247, 267, 249]);

    	$products = $products->relationModel()->orderBy('nid');

    	$excel = null;

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni or !$product->price ) continue;

					$excel[] = [
						'ID' => $product->nid,
						'Item title' => strip_tags($product->cproducts_vni),
						'Final URL' => str_replace('.', '%2C',$product->link),
						'Type' => $product->storeStatus,
						'Category' => $product->category->ccode,
						'Sex' => $product->gender,
						'Price' => $product->price,
						'Sale price' => $product->price_off,
					];
    		}

    	});

    	$excel_name = 'excel_by_Category_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.xlsx';

    	return response()->download($pathToFile);
    }

    public function excelByCategoryQT()
    {

    	$products = $this->ProductWatch::query();
    	/*
		Tissot 221
		Frederique Constant 310
		Longines 249
		Versace 318
		Burberry 230
		Hublot 349
		Salvatore Ferragamo 267

		(221, 310,235,252,260,318,230,247,267,249)
		Tissot
		Fedrerique Constant
		Micheal Kors
		Swarovski
		Gucci
		Versace
		Burberry
		Movado
		Salvatore
		Longine 249
    	*/

		$products->where('nstatus', 1)->whereIn('nid_cat_products',[221, 310, 249, 318, 230, 349, 267]);

    	$products = $products->relationModel()->orderBy('nid');

    	$excel = null;

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni or !$product->price ) continue;

					$excel[] = [
						'Model Number' => $product->ccirle,
						'Item title' => strip_tags($product->cproducts_vni),
						'Collection' => $product->bo_suu_tap ?? '',
						'Brand name' => $product->category->ccat_products_vni,
						'Final URL' => str_replace('.', '%2C',$product->link),
					];
    		}

    	});

    	$excel_name = 'excel_by_Category_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.xlsx';

    	return response()->download($pathToFile);
    }

    public function excelStatus()
    {
    	$products = $this->ProductWatch::query();

    	$products->where('nstatus', 1);
    	$products = $products->relationModel()->orderBy('nid');

    	$excel = null;

    	$products->chunk(100, function($products) use (&$excel) {

    		foreach($products as $product){
    			if( !$product->cproducts_vni or !$product->price or !$product->ton ) continue;

					$excel[] = [
						'ID' => $product->nid,
						'Item title' => strip_tags($product->cproducts_vni),
						'Final URL' => str_replace('.', '%2C',$product->link),
						'Type' => $product->ton,
						'Category' => optional($product->category)->ccode,
						'Sex' => $product->gender,
						'Price' => $product->price,
						'Sale price' => $product->price_off,
					];
    		}

    	});

    	$excel_name = 'excelStatus_'.date('Y-m-d-H-m-s');
    	$data = ExcelSupport::store($excel, $excel_name, false, 'export');
    	$pathToFile = public_path() . '/upload/export/' . $excel_name . '.xlsx';
    	return response()->file($pathToFile);
    }
}
