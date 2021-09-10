<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use App\Http\Livewire\WithDepartment;
use App\Support\HasAdvancedFilter;

class File extends Model
{
    use HasFactory;
    use WithDepartment;
    use Auditable;
    use HasAdvancedFilter;
    
    protected $table = 'files';

    public $orderable = [
        'register_no',
        'date_opened',
        'file_no',
        'section_id',
        'file_name',
        'dealing_staff',
    ];

    public $filterable = [
        'file_no',
        'file_name',
        'dealing_staff',
    ];

    protected $fillable = [
        'register_no', 
        'date_opened', 
        'file_type',
        'file_no', 
        'file_name', 
        'section_id', 
        'dealing_staff', 
        'remarks', 
        'closed_date', 
        'categorized_by',
        'categorized_id',
        'entered_by',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function incomings()
    {
        return $this->hasMany(Incoming::class);
    }

    public function outgoings()
    {
        return $this->hasMany(Outgoing::class);
    }
}
