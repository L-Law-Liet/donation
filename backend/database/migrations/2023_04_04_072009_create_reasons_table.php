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
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('num');
            $table->string('name');
            $table->string('yid_name')->nullable();
            $table->string('email')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('cell')->nullable();
            $table->string('url')->nullable();
            $table->unsignedDecimal('goal')->default(0);

            $table->foreignId('campaign_id')->nullable()->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reason_id')->nullable()->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reasons');
    }
};
