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
        Schema::create('target_scopes', function (Blueprint $table) {
            $table->id();


            $table->foreignId('target_id')
                ->constrained('targets')
                ->cascadeOnDelete();

            $table->string('asset');
            $table->string('asset_type')->default('url');

            $table->string('scope_status');
            // in_scope or out_of_scope

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['target_id', 'scope_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_scopes');
    }
};
