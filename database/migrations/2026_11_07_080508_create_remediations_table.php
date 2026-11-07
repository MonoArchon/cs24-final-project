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
        Schema::create('remediations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finding_id')
                ->constrained('findings')
                ->cascadeOnDelete();

            $table->longText('recommendation');

            $table->string('remediation_status')
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remediations');
    }
};
