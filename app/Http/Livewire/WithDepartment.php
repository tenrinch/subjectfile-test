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

            static::addGlobalScope('department_id', function (Builder $builder) {
                $builder->where('department_id', auth()->user()->department_id);
            });
        }
    }

}
