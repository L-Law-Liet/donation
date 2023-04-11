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
        Schema::create('donor_tag', function (Blueprint $table) {
            $table->foreignId('donor_id')->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_tag');
    }
};
