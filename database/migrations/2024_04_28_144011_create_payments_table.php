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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('expiration');
            $table->string('status');//payed,late,partial,
            $table->integer('partial')->default(0);
            $table->foreignId('fee_assign_id')
                ->constrained('fee_assigns');
            $table->integer('late')->default(0);
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
