<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScanArtifact extends Model
{
    protected $fillable = [
        'scan_run_id',
        'artifact_type',
        'file_path',
        'content',
    ];

    public function scanRun(): BelongsTo
    {
        return $this->belongsTo(ScanRun::class);
    }
}