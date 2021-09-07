<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;
use Carbon\Carbon;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incoming extends Model
{
    use WithDepartment;
    use HasFactory;
    use Auditable;
    use HasAdvancedFilter;
    
    protected $table = 'incomings';

    public $orderable = [
        'incoming_no',
        'received_date',
        'file_no',
        'sender_id',
        'status',
        'created_at',
    ];

    public $filterable = [
        'subject',
        'sender_id',
    ];

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
        'language',
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, 'file_id');
    }
    public function files()
    {
        return $this->medias()->where('type', 'incoming');
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

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($doc) { // before delete() method call this

            if ($doc->files) {
                foreach ($doc->files as $file) {
                    $file->delete();
                }
            }
        });
    }
}
