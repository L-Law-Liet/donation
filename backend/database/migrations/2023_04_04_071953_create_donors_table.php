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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('acc')->nullable();
            $table->string('yid_name1')->nullable();
            $table->string('yid_name2')->nullable();
            $table->string('yid_title1')->nullable();
            $table->string('yid_title2')->nullable();
            $table->string('eng_pre')->nullable();
            $table->string('eng_name1')->nullable();
            $table->string('eng_name2')->nullable();
            $table->json('locations');
            $table->boolean('is_donor')->default(true);

            $table->foreignId('child_id')->nullable()->constrained('donors')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pair_id')->nullable()->constrained('donors')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
