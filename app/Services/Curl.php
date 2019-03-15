<?php
namespace App\Services;

class Curl
{
	public function send($url, $method = 'GET', $data = null, $retry = 2)
	{
	    $retrytime = 0;
	    retry_from_here:

	    $ch = curl_init();

	    // set URL and other appropriate options
	    curl_setopt($ch, CURLOPT_URL, $url); // use Random to generate unique URL every connect
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0');
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

	    // check data send to remote
	    if ($data) {
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    }
	    
	    //curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
	    //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
	    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // follow 302 header
	    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE); //Don't use cache version, "Cache-Control: no-cache"
	    //curl_setopt($ch, CURLOPT_VERBOSE, 1); //for get header
	    //curl_setopt($ch, CURLOPT_HEADER, 1); //for get header
	    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    //     'Content-Type: application/json',                                                                                
	    //     'Content-Length: ' . strlen($data_string))                                                                       
	    // ); 

	    // grab URL and pass it to the browser
	    $response = curl_exec($ch);

	    if ($response == '' AND $retrytime <= $retry) {
	        $retrytime++;
	        goto retry_from_here;
	    }

	    curl_close($ch);

	    return $response;
	}
}

