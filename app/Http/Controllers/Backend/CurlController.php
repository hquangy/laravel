<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Curl;

class CurlController extends Controller
{
	public $Curl;

	public function __construct()
	{
		$this->Curl = new Curl;
	}

    public function getPage(Request $request)
    {
    	// $url_page = $request->page;
    	// if( !$url_page ) return;

    	// $response = $this->Curl->send($url_page);
    	// return $response;

    	set_time_limit(0);
    	$link = 'https://comtamcali.com/';

    	$proxy = trim( file_get_contents(public_path('upload/proxy.txt')) );
    	$proxy = explode("\r\n", $proxy);
    	echo $this->getData($link, $proxy[rand(0, count($proxy)-1)]);

    }

    private function getData($link, $proxy = null, $proxy_type = null)
    {

    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $link);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36');
    	curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/');
    	curl_setopt($ch, CURLOPT_ENCODING, '');

    	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

    	#set proxy
    	if($proxy) {
    		curl_setopt($ch, CURLOPT_PROXY, $proxy);
    		if($proxy_type) curl_setopt($ch, CURLOPT_PROXYTYPE, $proxy_type);
    	}
    	// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);

    	#end proxy

    	#set header array
    	// $headers = [];
    	// $headers[] = 'Host: comtamcali.com';
    	// $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0';
    	// $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    	// $headers[] = 'Accept-Language: vi-VN,vi;q=0.8,en-US;q=0.5,en;q=0.3';
    	// $headers[] = 'Accept-Encoding: gzip, deflate, br';
    	// $headers[] = 'Connection: keep-alive';
    	// $headers[] = 'Cookie: _ga=GA1.2.293656551.1549204916; _gcl_au=1.1.856485504.1549204916; XSRF-TOKEN=eyJpdiI6IlhoMjRkUlpUNUxteFhtWjhvZTZ2d3c9PSIsInZhbHVlIjoieHRjNDJrTGZyS1Bsc1BlZ3FcL1BwZG1PV0RyenY1ZzE0RlRTYUswd3JXYnZpaWRcL3o2MkdcLzBKQUlBZ3EySkJjQndOcER2S25WXC93UTRCUzdWMW5MQklnPT0iLCJtYWMiOiI2NjgxYWU2ZjYxMDRiN2UyNzQ5ZjI4OGFkYzMzMmMyZmZhODg2YTRjNzY2MWZkNzUwNjgxY2E0NzdkMTc5MGI5In0%3D; laravel_session=eyJpdiI6Im9CMFFyZWJMOE05dlFsQ0pOcFdWaGc9PSIsInZhbHVlIjoiYkppUWtZTU9SMyszbUJsc2tvRllXMHVOcDM4Sm5OZFcraDVwdXRYaTgxcnNPYkJrMVBvNnA2Wnd1RFlUTmIrendtNENZUnZkRWlrNWc4RnMyNjNuQlE9PSIsIm1hYyI6ImU5NTYzZDJhMTkxMjU1M2UxYTk5ZTgzYjkzNzZkZjY4NzdlNGQ3NjRhMDEzMzEzZTAwZmU4NDVhMTY1MzQ0MjYifQ%3D%3D; _gid=GA1.2.637257419.1550484944; _gat_gtag_UA_120909160_1=1; _gat_gtag_UA_118469042_2=1';
    	// $headers[] = 'Upgrade-Insecure-Requests: 1';
    	// $headers[] = 'TE: Trailers';
    	# end set header array

    	// curl_setopt($ch, CURLOPT_HEADER, true);
    	// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	$re = curl_exec($ch);

    	curl_close($ch);
    	return $re;
    }

    private function check_proxy_live($proxy)
    {

    }
}
