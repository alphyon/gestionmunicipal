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
        Schema::create('legal_companies', function (Blueprint $table) {
            $table->id();
            $table->string('first_names');
            $table->string('last_name')->nullable();
            $table->string('type')->comment('accountant/representative');
            $table->string('identity_number');
            $table->string('document_type');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->foreignId('company_id')->constrained('companies');
             $table->foreignId('district_id')->constrained('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_companies');
    }
};
