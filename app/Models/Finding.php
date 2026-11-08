<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Finding extends Model
{
    protected $fillable = [
        'assessment_id',
        'title',
        'vulnerability_type',
        'severity',
        'source',
        'description',
        'affected_asset',
        'status',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function evidence(): HasMany
    {
        return $this->hasMany(FindingEvidence::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(FindingReview::class);
    }

    public function remediations(): HasMany
    {
        return $this->hasMany(Remediation::class);
    }

    public function aiAnalyses(): HasMany
    {
        return $this->hasMany(AIAnalysis::class);
    }
}