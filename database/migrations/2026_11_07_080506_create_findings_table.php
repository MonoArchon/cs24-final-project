<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('findings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('vulnerability_type');

            $table->string('severity')->default('informational');

            $table->string('source')->default('tool');
            // tool or ai

            $table->text('description')->nullable();

            $table->string('affected_asset')->nullable();

            $table->string('status')
                ->default('pending_verification');

            $table->timestamps();

            $table->index(['assessment_id', 'severity']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('findings');
    }
};
