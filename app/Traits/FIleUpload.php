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
		foreach($files as $file) 
        {
            $file_name = $file->getClientOriginalName();
            $media = [];
            $media['type']      = $type;
            $media['name']      = $file_name;
            $media['path']      = $file->store(auth()->user()->department->slug.'/'.$type.'/'.date('Y').'/'.date('m'));

            $model->medias()->create($media);
        }
	}
}
