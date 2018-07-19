<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Upload;

class Page extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at','expires_at'];

    # nội tại
    public function uploadImage($file, $folder = null)
    {
    	$folder = $folder ? $folder : 'uploads';
    	$filename = $this->slug . '-'.rand(0,100000).'.' .$file->getClientOriginalExtension();
        return Upload::uploadFile($file, $folder, $filename);
    }

    public function link()
    {
    	return $this->slug;
    }
}
