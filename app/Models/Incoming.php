<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;
use Carbon\Carbon;

class Incoming extends Model
{   
    use WithDepartment;
    use HasFactory;

    protected $table = 'incomings';

    protected $fillable = [
        'incoming_no',
        'file_no',
        'letter_no',
        'letter_date',
        'received_date',
        'year', 
        'sender_id', 
        'subject', 
        'status', 
        'entered_by',
        'department_id',
        'mode',
        'urgency',
        'category_id',
        'remarks',
    ];

    public function medias()
    {
        return $this->hasMany(Media::class,'file_id');
    }
    public function files()
    {
        return $this->medias()->where('type','incoming');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    } 

    public function sender()
    {
        return $this->belongsTo(SenderDestination::class,'sender_id')->withDefault([
            'title' => 'Incorrect Selection!'
        ]);
    } 

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'title' => 'Incorrect Selection!'
        ]);
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
