<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SenderDestination extends Model
{
    use HasFactory;

    protected $fillable = ['title','fixed','department_id'];

    static function list()
    {
        return SenderDestination::where('fixed',1)
        ->where('department_id',Auth::user()->department_id)
        ->get();
    }
}
