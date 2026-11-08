<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Target extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'base_url',
        'description',
        'status',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function scopes(): HasMany {
        return $this->hasMany(TargetScope::class);
    }

    public function assessments(): HasMany {
        return $this->hasMany(Assessment::class);
    }
}