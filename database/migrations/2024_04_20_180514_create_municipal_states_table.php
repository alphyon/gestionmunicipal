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
        Schema::create('municipal_states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->boolean('status')->default(true);
            $table->string('manager')->nullable();
            $table->unsignedInteger('zone')->nullable();
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipal_states');
    }
};
