<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\Store;

class RegionController extends Controller
{
	public function districtsHaveStoreJson($idCity)
	{
		$districts = Region::listDistrictsHaveStores($idCity);

		$more = collect([
			'id' => '-1',
			'full_title' => 'Tất cả quận, huyện',
			'title' => 'Tất cả quận, huyện',
		]);

		$districts->prepend($more);

		$districts = $districts->map(function ($district) {
			return collect($district->toArray())
			->only(['id', 'full_title'])
			->all();
		});

		return response()->json([$districts],200);
	}

	public function allDistricts($idCity)
	{
		$districts = Region::listAllDistricts($idCity);

		$districts = $districts->map(function ($district) {
			return collect($district->toArray())
			->only(['id', 'full_title'])
			->all();
		});

		return response()->json([$districts],200);
	}

	public function districtsHaveStoreHtml($idDistrict)
	{
		$stores = Store::where('district','=',$idDistrict)
		->where('visibility', '=', 1)->get();
		$view = view('frontend_v2.lien_he._stores',compact('stores'))->render();
		return response()->json(['data'=>$view],200);
	}

	public function citiesHaveStoreHtml($idCity)
	{
		$stores = Store::where('city','=',$idCity)
		->where('visibility', '=', 1)->get();
		$view = view('frontend_v2.lien_he._stores',compact('stores'))->render();
		return response()->json(['data'=>$view],200);
	}

}
