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
        Schema::create('fee_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('taxable_type')
                ->comment('reference state,spot,company');
            $table->unsignedInteger('taxable_id');
            $table->foreignId('fee_id')->constrained('fees');
            $table->boolean('expiration')->default(false);
            $table->integer('cycle_days')->default(0);
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_assigns');
    }
};
