<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;


class SenderDestination extends Model
{
    use WithDepartment;
    use HasFactory;
    use Auditable;

    protected $fillable = ['title', 'fixed', 'department_id'];
}
