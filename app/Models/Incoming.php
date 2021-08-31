<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;

class Incoming extends Model
{
    use WithDepartment;

    use HasFactory;
    use Auditable;

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

    public function senders()
    {
        return $this->belongsTo(SenderDestination::class, 'sender');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
