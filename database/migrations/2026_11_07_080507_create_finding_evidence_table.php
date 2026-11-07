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
        Schema::create('finding_evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finding_id')
                ->constrained('findings')
                ->cascadeOnDelete();

            $table->string('evidence_type');

            $table->longText('evidence_content')->nullable();

            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finding_evidence');
    }
};
