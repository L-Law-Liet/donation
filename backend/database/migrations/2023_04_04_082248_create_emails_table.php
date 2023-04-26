<?php

use App\Models\Email;
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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(Email::TYPE_DEFAULT);
            $table->boolean('primary')->default(false);
            $table->string('value')->nullable();

            $table->foreignId('donor_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
