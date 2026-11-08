<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FindingEvidence extends Model
{
    protected $fillable = [
        'finding_id',
        'evidence_type',
        'evidence_content',
        'file_path',
    ];

    public function finding(): BelongsTo
    {
        return $this->belongsTo(Finding::class);
    }
}