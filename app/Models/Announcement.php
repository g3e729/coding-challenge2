<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'active',
        'startDate',
        'endDate',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'startDate',
        'endDate',
    ];

    public function scopeIsActive($query)
    {
        return $query->whereActive(1);
    }

    public function poster()
    {
        return $this->belongsTo(User::class);
    }
}
