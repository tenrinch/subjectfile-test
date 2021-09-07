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

    protected $table = 'sender_destinations';

    protected $fillable = ['title', 'fixed', 'department_id', 'subsenderdestination_of'];

    public function child()
    {
        return $this->hasMany(SenderDestination::class, 'subsenderdestination_of');
    }
    public function parent()
    {
        return $this->belongsTo(SenderDestination::class, 'subsenderdestination_of');
    }
    /*  public static function boot()
    {
        parent::boot();

        self::deleting(function ($senderdestinationd) { // before delete() method call this
            Category::where('subsenderdestination_of', $category->id)
                ->update(['sub_of' => null]);
        });
    } */
}
