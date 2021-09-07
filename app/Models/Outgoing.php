<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;
use Carbon\Carbon;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outgoing extends Model
{
    use WithDepartment;
    use HasFactory;
    use Auditable;
    use SoftDeletes;
    use HasAdvancedFilter;
    
    protected $table = 'outgoings';

    public $orderable = [
        'dispatched_no',
        'dispatched_date',
        'file_no',
        'destination_id',
        'status',
        'created_at',
    ];

    public $filterable = [
        'subject'
    ];


    protected $fillable = [
        'file_no',
        'dispatched_no',
        'dispatched_date',
        'year', 
        'destination_id', 
        'subject', 
        'status', 
        'entered_by',
        'department_id',
        'category_id',
        'mode',
        'urgency',
        'remarks',
        'language',
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

    public function destination()
    {
        return $this->belongsTo(SenderDestination::class,'destination_id')->withDefault([
            'title' => 'Incorrect Selection!'
        ]);
    } 

    public function destinations()
    {

        return $this->belongsToMany(SenderDestination::class,'destination_outgoing','outgoing_id','destination_id');
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
