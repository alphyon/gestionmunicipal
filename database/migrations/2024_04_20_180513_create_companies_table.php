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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('commercial_name');
            $table->string('commercial_activity')->comment('reference MH catalog');
            $table->string('file');
            $table->string('type');
            $table->string('NRC');
            $table->string('NIT');
            $table->string('email');
            $table->boolean('status');
            $table->string('address');
            $table->unsignedInteger('street');
            $table->unsignedInteger('avenue');
            $table->unsignedInteger('passage');
            $table->unsignedInteger('colony');
            $table->string('block');
            $table->string('num_house');
            $table->string('reference');
            $table->string('phone');
            $table->date('operation_start');
            $table->boolean('declare')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
