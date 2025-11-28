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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->boolean('main_service')->default(0);      // Only 1 allowed
            $table->boolean('featured_service')->default(0); // Only 3 allowed

            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
