<?php
namespace App\Services;

class Upload
{
	public static function uploadFile($file, $folder = null, $filename = null)
	{
		if(!$file or !$folder or !$filename) return false;

		$file_ext = $file->getClientOriginalExtension();
		$fullname = $filename . '.' .$file_ext;

		$fulluploaddir_path = public_path($folder);

		// create folder if not exist
		if (!file_exists($fulluploaddir_path)) {
		    mkdir($fulluploaddir_path, 0777, true);
		}

		$file->move(rtrim($folder,'/'), $fullname);

		return $folder .'/'.$fullname;

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

	}
}

