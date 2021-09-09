<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use Auditable;

    protected $table = 'departments';

    protected $fillable = [
        'title',
        'parent_id',
        'slug',
    ];

    public function sections()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function staff()
    {

        return $this->hasMany(User::class,'department_id');
    }
}
