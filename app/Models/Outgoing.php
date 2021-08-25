<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\App;
use Illuminate\Support\Facades\Auth;

class Outgoing extends Model
{
    use HasFactory;

    protected $table = 'outgoings';

    protected $fillable = [
        'file_no',
        'dispatched_no',
        'dispatched_date',
        'year', 
        'destination', 
        'subject', 
        'status', 
        'entered_by',
        'department_id',
        'category_id',
        'mode',
        'urgency'
    ];

    public function medias()
    {
        return $this->hasMany(Media::class,'file_id');
    }
    public function files()
    {
        return $this->medias()->where('type','outgoing');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    } 

    public function destinations()
    {
        return $this->belongsTo(SenderDestination::class,'destination');
    } 

    public function category()
    {
        return $this->belongsTo(Category::class);
    } 

    //List out the incomings belonging to the same department
    public static function list()
    {      
        return self::where('department_id',Auth::user()->department_id)
            ->orderBy('year')
            ->orderBy('dispatched_no')
            ->get();
    }

    //List out the incomings belonging to the authenticated user
    public static function staff()
    {     
        return self::where('entered_by',Auth::id()) 
            ->orderBy('year')
            ->orderBy('dispatched_no')
            ->get();
    }

    public static function boot() {
        parent::boot();

        self::deleting(function($doc) 
        { // before delete() method call this

            if($doc->files){
                foreach($doc->files as $file)
                {
                    $file->delete();
                }
                    
            }

        });
    }

}
