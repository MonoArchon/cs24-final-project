<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TargetScope extends Model
{
    protected $fillable = [
        'target_id',
        'asset',
        'asset_type',
        'scope_status',
        'notes',
    ];

    public function target(): BelongsTo
    {
        return $this->belongsTo(Target::class);
    }
}