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

    public function files()
    {
        return $this->hasMany(Media::class,'file_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    } 

    public function destinations()
    {
        return $this->belongsTo(SenderDestination::class,'destination');
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

}
