<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;

class Outgoing extends Model
{
    use WithDepartment;
    use HasFactory;
    use Auditable;

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
        return $this->hasMany(Media::class, 'file_id');
    }
    public function files()
    {
        return $this->medias()->where('type', 'outgoing');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function destinations()
    {
        return $this->belongsTo(SenderDestination::class, 'destination');
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
