<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    public function home()
    {
    	return redirect_301('/');
    }

    public function thuc_don()
    {
    	return redirect_301('thuc-don');	
    }

    public function lien_he()
    {
    	return redirect_301('lien-he');	
    }

    public function tuyen_dung()
    {
    	return redirect_301('tuyen-dung');	
    }
}
