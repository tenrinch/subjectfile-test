<?php
namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;

trait WithDepartment {

    protected static function bootWithDepartment()
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                if ($model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'entered_by')) 
                {
                    $model->entered_by = auth()->id();
                }
                
                $model->department_id = auth()->user()->department_id;
            });

            static::addGlobalScope('department_id', function (Builder $builder){

                if(auth()->user()->roles()->whereIn('title', ['Admin','Coordinator'])->exists())
                {
                    $depts = auth()->user()->department->sections()->pluck('id')->toArray();
                    array_push($depts,auth()->user()->department_id);
                    $builder->whereIn('department_id', $depts);
                }
                else
                {
                    $builder->where('department_id',auth()->user()->department_id);
                }
            });
        }
    }

}
