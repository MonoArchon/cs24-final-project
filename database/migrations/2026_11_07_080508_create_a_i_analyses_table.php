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
        Schema::create('a_i_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();

            $table->foreignId('finding_id')
                ->nullable()
                ->constrained('findings')
                ->nullOnDelete();

            $table->string('analysis_type');
            // explanation, remediation, risk_prioritization,
            // assessment_summary

            $table->longText('prompt')->nullable();

            $table->longText('response')->nullable();

            $table->string('model_name')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(['assessment_id', 'analysis_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_analyses');
    }
};
