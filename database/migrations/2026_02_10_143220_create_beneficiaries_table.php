<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('rut')->unique();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('commune')->nullable();
            $table->string('profile_type');
            $table->string('disability_type');
            $table->string('age_range')->nullable();
            $table->string('gender')->nullable();
            $table->string('territory')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
};
