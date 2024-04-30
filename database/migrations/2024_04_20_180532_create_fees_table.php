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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->boolean('status')->default(true);
            $table->date('date_init');
            $table->date('date_end')->nullable();
            $table->unsignedInteger('period')->nullable();
            $table->string('adjust')->nullable()
                ->comment('define discount or increase');
            $table->foreignId('tax_id')->constrained('taxes');
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
