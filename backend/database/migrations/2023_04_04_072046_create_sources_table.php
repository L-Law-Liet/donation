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
            $table->string('event')->nullable();
            $table->string('product')->nullable();
            $table->string('device_name')->nullable();
            $table->string('activation_code')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('plan')->nullable();
            $table->string('device_type')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('device_num')->nullable();
            $table->string('sim_num')->nullable();
            $table->dateTime('activated')->nullable();
            $table->dateTime('deactivated')->nullable();
            $table->string('organization')->nullable();
            $table->string('version')->nullable();
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
        Schema::dropIfExists('sources');
    }
};
