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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name');                 // Client name
            $table->string('email')->nullable();    // Client email
            $table->string('phone')->nullable();    // Client phone
            $table->string('company')->nullable();  // Company / Farm / Business name
            $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
