<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Media extends Model
{
    use HasFactory;

    protected $table = "media";

    protected $fillable = ['name','path', 'file_id', 'type'];

    public function incoming()
    {
        return $this->belongsTo(Incoming::class,'file_id');
    }

    public function outgoing()
    {
        return $this->belongsTo(Outgoing::class,'file_id');
    }

    public static function boot() {
        parent::boot();

        self::deleting(function($file) 
        { 
            Storage::delete($file->path);
        });
    }
}
