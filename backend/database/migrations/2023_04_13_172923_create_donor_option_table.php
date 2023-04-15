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
        Schema::create('donor_option', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_option');
    }
};
