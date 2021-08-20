<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = "media";

    protected $fillable = ['path', 'file_id'];

    public function incoming()
    {
        return $this->belongsTo(Incoming::class);
    }

    public function outgoing()
    {
        return $this->belongsTo(Outgoing::class);
    }
}
