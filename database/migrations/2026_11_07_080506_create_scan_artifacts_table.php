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
        Schema::create('scan_artifacts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('scan_run_id')
                ->constrained('scan_runs')
                ->cascadeOnDelete();

            $table->string('artifact_type');
            // JSON, XML, TXT, HTML

            $table->string('file_path')->nullable();

            $table->longText('content')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scan_artifacts');
    }
};
