<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();

            // required (first 3)
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // optional / nullable
            $table->string('fax')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->text('map')->nullable();
            $table->string('slogan')->nullable();
            $table->string('reg')->nullable(); // registration number
            $table->text('about_us')->nullable();
            $table->text('company_mission')->nullable();
            $table->text('company_vision')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variables');
    }
}
