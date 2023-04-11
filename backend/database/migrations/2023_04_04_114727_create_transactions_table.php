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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedDecimal('amount');
            $table->string('type');
            $table->string('note')->nullable();
            $table->string('check_num')->nullable();
            $table->string('int_note')->nullable();
            $table->string('ext_note')->nullable();
            $table->string('ref')->nullable();

            $table->foreignId('reason_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('donor_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('collector_id')->nullable()->constrained('donors')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('card_id')->nullable()->constrained()
                ->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
