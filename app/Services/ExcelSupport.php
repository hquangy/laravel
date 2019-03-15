<?php
namespace App\Services;

use Excel;

class ExcelSupport
{
	public static function uploadFile($file, $folder = null, $filename = null)
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

		$ext = $file->getClientOriginalExtension();
		$file->move(rtrim($folder,'/'), $filename .'.'.$ext);
		return $folder .'/'.$filename.'.'.$ext;
	}

	/*
		export data to xlsx and download file
	*/
	public static function export($data, $excel_name = null)
	{
		$excel_name = $excel_name ? $excel_name : uniqid();

		$excel_name = date('Y') . '-' . date('m') .'-'. date('d').'-'.date('H'). '-'.date('i'). '-'.date('s'). '-'.$excel_name . '-'. rand(100,999);

		Excel::create($excel_name, function($excel) use ($data) {
			$excel->setTitle('Data product');
			$excel->setCreator('ecom')->setCompany('ecom');
			$excel->setDescription('data file');

			// Build the spreadsheet, passing in the payments array
			$excel->sheet('sheet1', function($sheet) use ($data) {
                $sheet->setPageMargin(0.1);
			    $sheet->fromArray($data, null, 'A1', false, false);
			});

		})->download('xlsx');
	}

	/*
		export data to xlsx and save it on server
	*/
	public static function store($data, $excel_name = null, $uniqid = false, $folder_name = null, $type = 'xlsx')
	{
        // Make foler contain export
        if (! file_exists(public_path('upload/'.$folder_name))) {
            mkdir(public_path('upload/'.$folder_name), 777, true);
        }

		$excel_name = $excel_name ? $excel_name : uniqid();
		$excel_name = $uniqid ? date('Y') . '-' . date('m') .'-'. date('d').'-'.date('H'). '-'.date('i'). '-'.date('s'). '-'.$excel_name . '-'. rand(100,999) : $excel_name;

		Excel::create($excel_name, function($excel) use ($data) {
			$excel->setTitle('Data product');
			$excel->setCreator('ecom')->setCompany('ecom');
			$excel->setDescription('data file');

			// Build the spreadsheet, passing in the payments array
			$excel->sheet('sheet1', function($sheet) use ($data) {
                $sheet->setPageMargin(0.1);
			    $sheet->fromArray($data, null, 'A1', false, true);
			    // $sheet->getStyle('A1:H' . $sheet->getHighestRow())
			    // ->getAlignment()->setWrapText(true);
			});

		})
		->store($type, public_path('upload/'.$folder_name));

		return public_path('upload/'.$folder_name.'/'.$excel_name.'.xlsx');
	}

	/*
	load file xlsx and return php variable
	*/
	public static function excelToPhp($file)
	{
		return Excel::load($file, function($reader) {

		})->get();
	}
}

