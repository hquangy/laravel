<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurlController extends Controller
{
    public function index(Request $request)
    {
    	$link = '';

    	set_time_limit(0);
    	//This is the file where we save the    information
    	$fp = fopen (storage_path() . '/download/localfile.mp4', 'w+');

    	//Here is the file we are downloading, replace spaces with %20
    	$ch = curl_init(str_replace(" ","%20",$link));
    	curl_setopt($ch, CURLOPT_TIMEOUT, 60000);

    	// write curl response to file
    	curl_setopt($ch, CURLOPT_FILE, $fp); 
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    	// get curl response
    	curl_exec($ch); 
    	curl_close($ch);
    	fclose($fp);
    }
}
