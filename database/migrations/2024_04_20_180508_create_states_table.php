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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('use to habit or commercial');
            $table->string('code')->index();
            $table->boolean('status')->default(true);
            $table->string('zone');
            $table->string('NIS')->nullable();
            $table->string('file')->nullable();
            $table->unsignedInteger('street')->nullable();
            $table->unsignedInteger('avenue')->nullable();
            $table->unsignedInteger('colony')->nullable();
            $table->unsignedInteger('passage')->nullable();
            $table->string('block')->nullable();
            $table->string('number_house')->nullable();
            $table->text('reference')->nullable();
            $table->json('data_geo_json');
            $table->date('register');
            $table->float('measure');
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
        Schema::dropIfExists('states');
    }
};
