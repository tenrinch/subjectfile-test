<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Hash;
use App\Traits\Auditable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;
    use Notifiable;
    use Auditable;

    public $table = 'users';

    public $orderable = [
        'id',
        'name',
        'email',
        'email_verified_at',
    ];

    public $filterable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'roles.title',
        'department.title',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('title', 'Admin')->exists();
    }

    public function scopeAdmins()
    {
        return $this->whereHas('roles', fn ($q) => $q->where('title', 'Admin'));
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    static function listStaff()
    {
        return User::whereHas('roles', fn ($q) => $q->where('title', 'Staff'))
            ->where('department_id', Auth::user()->department_id)
            ->where('id', '<>', Auth::id())
            ->get();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Role::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
