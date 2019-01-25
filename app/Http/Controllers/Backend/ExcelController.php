<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductWatch;

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

    public function excelGoogleMerchant()
    {
    	$item = $this->ProductWatch->where('nid', '293489')->first();

    	dd($item);
    }
}
