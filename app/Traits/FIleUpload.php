<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Media;

trait FileUpload
{	
	use WithFileUploads;

	public static function uploads($files,$model,$type)
	{	
        $url = auth()->user()->department->parent
                ? auth()->user()->department->parent->slug.'/'.auth()->user()->department->slug.'/'.$type.'/'.date('Y').'/'.date('m')
                : auth()->user()->department->slug.'/'.$type.'/'.date('Y').'/'.date('m');

		foreach($files as $file) 
        {   
            $file_name = $file->getClientOriginalName();
            $media = [];
            $media['type']      = $type;
            $media['name']      = $file_name;
            $media['path']      = $file->store($url);

            $model->medias()->create($media);
        }
	}
}
