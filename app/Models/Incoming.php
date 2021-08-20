<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Incoming extends Model
{
    use HasFactory;

    protected $table = 'incomings';

    protected $fillable = [
        'incoming_no',
        'file_no',
        'dispatched_no',
        'received_date',
        'year', 
        'sender', 
        'subject', 
        'status', 
        'entered_by',
        'department_id',
        'mode',
        'urgency',
        'category_id',
    ];

    public function files()
    {
        return $this->hasMany(Media::class,'file_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    } 

    //List out the incomings belonging to the same department
    static function list()
    {      
        return self::where('department_id',Auth::user()->department_id)
            ->orderBy('year')
            ->orderBy('incoming_no')
            ->get();
    }

    //List out the incomings belonging to the same department
    static function staff()
    {     
        return self::where('entered_by',Auth::id())->get();
    }

    public static function boot() {
        parent::boot();

        self::deleting(function($doc) 
        { // before delete() method call this

            if($doc->files){
                foreach($doc->files as $file)
                {
                    Storage::delete($file->path);
                    $file->delete();
                }
                    
            }

        });
    }
}
