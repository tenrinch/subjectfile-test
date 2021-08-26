<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\WithDepartment;

class Category extends Model
{   
    use WithDepartment;
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['title','department_id','subcategory_of'];

    public function departments()
    {
        return $this->belongsTo(Department::class);
    }

    public function child()
    {
        return $this->hasMany(Category::class,'subcategory_of');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'subcategory_of');
    }
    
    public static function boot() {
        parent::boot();

        self::deleting(function($category) 
        { // before delete() method call this
            Category::where('subcategory_of',$category->id)
            ->update(['subcategory_of'=>null]);
        });
    }
}
