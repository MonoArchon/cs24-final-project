<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'assessment_id',
        'generated_by',
        'report_name',
        'file_path',
        'status',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'generated_at' => 'datetime',
        ];
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function generator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'generated_by'
        );
    }
}