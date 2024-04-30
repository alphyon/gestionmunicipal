<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('location');
            $table->float('measure');
            $table->string('manager')->nullable();
            $table->string('manager_document')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('municipal_state_id')
                ->constrained('municipal_states');
            $table->foreignId('owner_id')->constrained('owners');
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
