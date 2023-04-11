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
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('device_name')->nullable();
            $table->date('date')->nullable();
            $table->string('pin')->nullable();

            $table->foreignId('reason_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('collector_id')->nullable()->constrained('donors')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sources');
    }
};
