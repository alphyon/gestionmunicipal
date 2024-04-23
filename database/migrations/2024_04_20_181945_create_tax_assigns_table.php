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
        Schema::create('tax_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('taxable_type')
                ->comment('reference state,spot,company');
            $table->unsignedInteger('taxable_id');
            $table->foreignId('tax_id')->constrained('taxes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_assigns');
    }
};
