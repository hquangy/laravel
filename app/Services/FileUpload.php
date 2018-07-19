<?php
namespace App\Services;

class FileUpload
{
	public static function file($file, $folder = null, $filename = null)
	{
		if(!$file) return null;
		$filename = $filename ? $filename : time();
		$folder = $folder ? $folder : 'upload';

		//Display File Name
		// echo 'File Name: '.$file->getClientOriginalName();
		
		//Display File Extension
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		
		//Display File Real Path
		// echo 'File Real Path: '.$file->getRealPath();
		
		//Display File Size
		// echo 'File Size: '.$file->getSize();
		
		//Display File Mime Type
		// echo 'File Mime Type: '.$file->getMimeType();

		$file->move(rtrim($folder,'/'), $filename);
		return '/'. $folder .'/'.$filename;
	}
}

