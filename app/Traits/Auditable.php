<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            self::audit('Created', $model);
        });

        static::updated(function (Model $model) {
            $model->attributes = array_merge($model->getChanges(), ['id' => $model->id]);
            self::audit('Updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('Deleted', $model);
        });
    }

    protected static function audit($description, $model)
    {
        $modelName = Str::afterLast(get_class($model), '\\');
        if($modelName == 'Incoming' || $modelName == 'Outgoing')
        {
            $link = asset('staff').'/'.lcfirst($modelName).'s/'.$model->id;
        }
        elseif($modelName == 'SenderDestination')
        {
            $link = asset('staff/sender-destinations');
        }
        else
        {
            $link = asset('staff/categories');
        }

        AuditLog::create([
            'description'  => $description,
            'subject_id'   => $model->id ?? null,
            'subject_type' => $modelName ?? null,
            'user_id'      => auth()->id() ?? null,
            'department_id'=> auth()->user()->department_id ?? null,
            'properties'   => $model ?? null,
            'host'         => request()->ip() ?? null,
            'link'         => $link ?? null,
        ]);
    }
}
