<?php
namespace App\Services;

use Carbon\Carbon;
use Image;
use App\ThuocDrug;
use App\File;
use File as PhpFile;

ini_set('max_execution_time', 3600);
class ImageUpload
{
	// upload image for seo facebook
	public function uploadImageFacebook($image, $folder = 'facebook', $file_name)
	{
		$folder = 'upload/' . $folder;
		return $image = $this->uploadFile($image, $folder, $file_name);
	}

	// upload image for post
	public function uploadImagePost($image, $folder = 'post', $file_name)
	{
		$folder = 'upload/post/' . $folder;
		return $image = $this->uploadFile($image, $folder, $file_name, 'image');
	}

	// upload image for category
	public function uploadImageCategory($image, $folder = 'category', $file_name)
	{
		$folder = 'upload/' . $folder;
		return $image = $this->uploadFile($image, $folder, $file_name, 'image');
	}
/*
	section upload basic
*/	
	public function uploadFile($file, $folder = null, $name = null, $mode = null)
	{
		$path = $this->makeFolder($folder);
		return $this->makeFile($file, $path, $name, $mode);
	}

	protected function makeFolder($folder = null)
	{
		if(!$folder){
			$relativeuploaddir_path = date('Y') . '/' . date('m');

			$fulluploaddir_path = public_path('upload/'.$relativeuploaddir_path);
			if (!file_exists($fulluploaddir_path)) {
			    mkdir($fulluploaddir_path, 0777, true);
			}
		}else{
			$relativeuploaddir_path = $folder;
			$fulluploaddir_path = public_path($folder);
			if (!file_exists($fulluploaddir_path)) {
			    mkdir($fulluploaddir_path, 0777, true);
			}
		}

		return [
			'full' => $fulluploaddir_path,
			'relative' => $relativeuploaddir_path,
		];
	}

	protected function makeFile($file, $path, $name = null, $mode = null)
	{
		if(!$name){
			$filename =  uniqid() . '-'.rand(1000, 9999) . '-' .date('Y') . '-' . date('m') . '-' . date('d');
		}else {
			$filename = $name;
		}

		$file_extension = $file->getClientOriginalExtension();
		$fullname = $filename . '.'.$file_extension;

		// mode = image
		if($mode == 'image'){
			return $this->imageResize($file, $filename, $file_extension, $path['relative']);
		}

		// normal = null
		if(!$mode){
			PhpFile::move($file, $path['full'] .'/' .$fullname);
			return $path['relative'] .'/'. $fullname;
		}

	}

	public function resize($path, $filename, $file_extension, $relativeuploaddir_path)
	{
		$fulluploaddir_path = public_path($relativeuploaddir_path);

		$newfilename = $filename . '.' .$file_extension;
		$largeFilename = $filename . '_large' . '.'.$file_extension;
		$mediumFilename = $filename . '_medium' . '.'.$file_extension;
		$smallFilename = $filename . '_small' . '.'.$file_extension;
		$thumbFilename = $filename . '_thumb' . '.'.$file_extension;

		$largeSize = 1200;
		$mediumSize = 600;
		$smallSize = 300;
		$thumbSize = 50;

		// resize and save image original
		// PhpFile::move($file, $fulluploaddir_path .'/'. $newfilename);
		// $file = $fulluploaddir_path .'/'. $path;
		$file = public_path($path);

		Image::make($file)
		    ->resize($largeSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $largeFilename);

		// save medium
		Image::make($file)
		    ->resize($mediumSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $mediumFilename);

		// save small
		Image::make($file)
		    ->resize($smallSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $smallFilename);

		// save thumb
		Image::make($file)
		    ->resize($thumbSize, $thumbSize, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $thumbFilename);

		return [
			'original' => $relativeuploaddir_path . '/' . $newfilename,
			'large' => $relativeuploaddir_path . '/'. $largeFilename,
			'medium' => $relativeuploaddir_path . '/'. $mediumFilename,
			'small' => $relativeuploaddir_path . '/'. $smallFilename,
			'thumb' => $relativeuploaddir_path . '/'. $thumbFilename,
		];
	}

	public function imageResize($file, $filename, $file_extension, $relativeuploaddir_path)
	{
		$fulluploaddir_path = public_path($relativeuploaddir_path);

		$newfilename = $filename . '.' .$file_extension;
		$largeFilename = $filename . '_large' . '.'.$file_extension;
		$mediumFilename = $filename . '_medium' . '.'.$file_extension;
		$smallFilename = $filename . '_small' . '.'.$file_extension;
		$thumbFilename = $filename . '_thumb' . '.'.$file_extension;

		$largeSize = 1200;
		$mediumSize = 600;
		$smallSize = 300;
		$thumbSize = 50;

		// resize and save image original
		PhpFile::move($file, $fulluploaddir_path .'/'. $newfilename);
		$file = $fulluploaddir_path .'/'. $newfilename;
		Image::make($file)
		    ->resize($largeSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $largeFilename,70);

		// save medium
		Image::make($file)
		    ->resize($mediumSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $mediumFilename,70);

		// save small
		Image::make($file)
		    ->resize($smallSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $smallFilename,70);

		// save thumb
		Image::make($file)
		    ->resize($thumbSize, $thumbSize, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path .'/'. $thumbFilename,70);

		return [
			'original' => $relativeuploaddir_path . '/' . $newfilename,
			'large' => $relativeuploaddir_path . '/'. $largeFilename,
			'medium' => $relativeuploaddir_path . '/'. $mediumFilename,
			'small' => $relativeuploaddir_path . '/'. $smallFilename,
			'thumb' => $relativeuploaddir_path . '/'. $thumbFilename,
		];
	}

/*
	/section upload basic
*/
	public static function uploadImageAndResize($id, $slug, $file, $folder = 'uploads/')
	{
		$relativeuploaddir_path = date('Y') . '/' . date('m') . '/';
		$fulluploaddir_path = public_path($folder . $relativeuploaddir_path);

		$filename = $id . '-' . str_slug($slug) .'-'. rand(1000, 9999) . '-' . substr(uniqid(), 0, 4);
		$file_extension = $file->getClientOriginalExtension();
		//$file_extension = pathinfo($file,PATHINFO_EXTENSION);

		$newfilename = $filename . '.'. $file_extension;
		$savepath = $fulluploaddir_path . $newfilename;

		if (!file_exists($fulluploaddir_path)) {
		    mkdir($fulluploaddir_path, 0777, true);
		}

		$largeFilename = $filename . '_large' . '.'.$file_extension;
		$mediumFilename = $filename . '_medium' . '.'.$file_extension;
		$smallFilename = $filename . '_small' . '.'.$file_extension;
		$thumbFilename = $filename . '_thumb' . '.'.$file_extension;

		$largeSize = 1200;
		$mediumSize = 600;
		$smallSize = 300;
		$thumbSize = 100;

		// // resize and save image original
		Image::make($file)
		    ->resize($largeSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $largeFilename,70);

		// save medium
		Image::make($file)
		    ->resize($mediumSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $mediumFilename,70);

		// save small
		Image::make($file)
		    ->resize($smallSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $smallFilename,70);

		// save thumb
		Image::make($file)
		    ->resize($thumbSize, $thumbSize, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $thumbFilename,70);

        // Save original
        Image::make($file)->save($fulluploaddir_path.$newfilename);

		return [
			'original' => $relativeuploaddir_path . $newfilename,
			'large' => $relativeuploaddir_path . $largeFilename,
			'meidum' => $relativeuploaddir_path . $mediumFilename,
			'small' => $relativeuploaddir_path . $smallFilename,
			'thumb' => $relativeuploaddir_path . $thumbFilename,
		];
	}

	public static function uploadReaizeImage($file)
	{
	    $folder = 'uploads/';
	    $uniqid = Carbon::now()->year. '.'.Carbon::now()->month.'_' .uniqid();

	    $mainFilename = $uniqid . '.'. $file->getClientOriginalExtension();
	    $mediumFilename = 'medium_' .$uniqid. '.'. $file->getClientOriginalExtension();
	    $smallFilename = 'small_' .$uniqid. '.'. $file->getClientOriginalExtension();
	    $thumbFilename = 'thumb_'.$uniqid. '.'. $file->getClientOriginalExtension();

	    // make folder
	    if(!file_exists(public_path($folder))){
	        mkdir(public_path($folder),0755,true);
	    }

	    // resize and save image original
	    Image::make($file)
	        ->resize(1080, null, function($constraint){
	            $constraint->aspectRatio();
	            $constraint->upsize();
	        })
	        ->save(public_path($folder).$mainFilename);

	    // save medium
	    Image::make($file)
	        ->resize(600, null, function($constraint){
	            $constraint->aspectRatio();
	            $constraint->upsize();
	        })
	        ->save(public_path($folder).$mediumFilename);

	    // save small
	    Image::make($file)
	        ->resize(300, null, function($constraint){
	            $constraint->aspectRatio();
	            $constraint->upsize();
	        })
	        ->save(public_path($folder).$smallFilename);

	    // save thumb
	    Image::make($file)
	        ->resize(50, null, function($constraint){
	            $constraint->aspectRatio();
	            $constraint->upsize();
	        })
	        ->save(public_path($folder).$thumbFilename);

	    return $mainFilename;
	}

	public static function uploadDrugImage($id,$name,$file)
	{
		return $data['cover'] = self::uploadImage($id,str_slug($name),$file);
	}

	public static function uploadDrugImages($id,$name,$files)
	{
		$data = [];
		$file_cover = array_shift($files);
		$data['cover'] = self::uploadImage($id,str_slug($name),$file_cover);

		$drug = ThuocDrug::where('ma_san_pham',$id)->first();

		if($drug){
			// drug exist, delete all images file
			$drug->deleteFile();
			foreach($drug->files as $file){
				$file->deleteFile();
				$file->delete();
			}

			$drug->filename = json_encode($data['cover']['_size']);
			$drug->save();


			$files_new = [];
			if(count($files)){
				foreach($files as $file){
					$file_new = File::create([
						'visibility' => 0
					]);
					$file_save = self::uploadImage($id,str_slug($name),$file,$file_new->id);

					$file_new->filename = json_encode($file_save['_size']);
					$file_new->save();

					$files_new[] = $file_new;
					$data['collection'][] = $file_save;
				}
			}

			$drug->files()->saveMany($files_new);
			return $data;
		}

		return 'file không tồn tại';

		// create drug
		// else{
		// 	$drug = ThuocDrug::create([
		// 		'ma_san_pham' => $id,
		// 		'ten' => $name,
		// 		'slug' => str_slug($name),
		// 		'visibility' => 0,
		// 		'filename' => json_encode($data['cover']['_size']),
		// 	]);
		// }

	}

	protected static function uploadImage($id, $slug, $file, $file_id = null){
		$relativeuploaddir_path = date('Y') . '/' . date('m') . '/';
		$fulluploaddir_path = public_path(config('nhathuoc.uploads.image') . $relativeuploaddir_path);
		$filename = $id . '-' . str_slug($slug) .'-'. rand(1000, 9999) . '-' . substr(uniqid(), rand(0,8), 4);
		$file_extension = $file->getClientOriginalExtension();
		$newfilename = $filename . '.'. $file_extension;
		$savepath = $fulluploaddir_path . $newfilename;

		if (!file_exists($fulluploaddir_path)) {
		    mkdir($fulluploaddir_path, 0777, true);
		}

		$largeFilename = $filename . '_large' . '.jpg';
		$mediumFilename = $filename . '_medium' . '.jpg';
		$smallFilename = $filename . '_small' . '.jpg';
		$thumbFilename = $filename . '_thumb' . '.jpg';

		$largeSize = 1200;
		$mediumSize = 600;
		$smallSize = 300;
		$thumbSize = 50;

		// // resize and save image original
		Image::make($file)
		    ->resize($largeSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $largeFilename);

		// save medium
		Image::make($file)
		    ->resize($mediumSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $mediumFilename);

		// save small
		Image::make($file)
		    ->resize($smallSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $smallFilename);

		// save thumb
		Image::make($file)
		    ->resize($thumbSize, $thumbSize, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $thumbFilename);

		// cover
		if(!$file_id){
			return [
				'id' => $id.'p',
				// '_info' => [
				//     'path' => config('nhathuoc.uploads.test') . $relativeuploaddir_path,
				//     'filename' => $newfilename,
				//     'size' => 'small:' . $smallSize . ',medium:' . $mediumSize . ',large:' . $largeSize . ',thumb:' . $thumbSize . 'x' . $thumbSize,
				// ],
				'_size' => [
					'original' => $relativeuploaddir_path . $newfilename,
					'large' => $relativeuploaddir_path . $largeFilename,
					'meidum' => $relativeuploaddir_path . $mediumFilename,
					'small' => $relativeuploaddir_path . $smallFilename,
					'thumb' => $relativeuploaddir_path . $thumbFilename,
				],
			];
		}

		// collection
		return [
			'id' => $file_id,
			// '_info' => [
			//     'path' => config('nhathuoc.uploads.test') . $relativeuploaddir_path,
			//     'filename' => $newfilename,
			//     'size' => 'small:' . $smallSize . ',medium:' . $mediumSize . ',large:' . $largeSize . ',thumb:' . $thumbSize . 'x' . $thumbSize,
			// ],
			'_size' => [
				'original' => $relativeuploaddir_path . $newfilename,
				'large' => $relativeuploaddir_path . $largeFilename,
				'meidum' => $relativeuploaddir_path . $mediumFilename,
				'small' => $relativeuploaddir_path . $smallFilename,
				'thumb' => $relativeuploaddir_path . $thumbFilename,
			],
		];

	}

	public static function findFile($folder, $filename)
	{
		$files = PhpFile::glob($folder. '/'. $filename);
		return $files;
	}


	/*
	$id = ma_san_pham
	$slug
	$file= file exist on server
	*/
	public static function resizeImage($id, $slug, $file)
	{
		$relativeuploaddir_path = date('Y') . '/' . date('m') . '/';
		$fulluploaddir_path = public_path(config('nhathuoc.uploads.image') . $relativeuploaddir_path);
		$filename = $id . '-' . str_slug($slug) .'-'. rand(100, 999) . generateRandomString(3);
		$file_extension = pathinfo($file,PATHINFO_EXTENSION);
		$newfilename = $filename . '.'. $file_extension;
		$savepath = $fulluploaddir_path . $newfilename;

		if (!file_exists($fulluploaddir_path)) {
		    mkdir($fulluploaddir_path, 0777, true);
		}

		$largeFilename = $filename . '_large' . '.jpg';
		$mediumFilename = $filename . '_medium' . '.jpg';
		$smallFilename = $filename . '_small' . '.jpg';
		$thumbFilename = $filename . '_thumb' . '.jpg';

		$largeSize = 1200;
		$mediumSize = 600;
		$smallSize = 300;
		$thumbSize = 50;

		$file = public_path($file);

		// resize and save image original
		Image::make($file)
		    ->resize($largeSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $largeFilename);

		// save medium
		Image::make($file)
		    ->resize($mediumSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $mediumFilename);

		// save small
		Image::make($file)
		    ->resize($smallSize, null, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $smallFilename);

		// save thumb
		Image::make($file)
		    ->resize($thumbSize, $thumbSize, function ($constraint) {
		        $constraint->aspectRatio();
		        $constraint->upsize();
		    })
		    ->save($fulluploaddir_path . $thumbFilename);

		// file move
		PhpFile::move($file, $fulluploaddir_path . $newfilename);

		return [
			'original' => $relativeuploaddir_path . $newfilename,
			'large' => $relativeuploaddir_path . $largeFilename,
			'meidum' => $relativeuploaddir_path . $mediumFilename,
			'small' => $relativeuploaddir_path . $smallFilename,
			'thumb' => $relativeuploaddir_path . $thumbFilename,
		];
	}
}

