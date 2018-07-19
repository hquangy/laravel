<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileUpload;

class Blog extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at','expires_at'];

	# nội tại
	public function uploadImage($file, $folder = null)
	{
		if(!$file) return null;
		$folder = $folder ? $folder : 'uploads';
		$filename = $this->slug . '-'.rand(0,100000).'.' .$file->getClientOriginalExtension();
	    return $this->filename = FileUpload::file($file, $folder, $filename);
	}

	public function link()
	{
		return url('uu-dai') . '/' .$this->slug;
	}
}
