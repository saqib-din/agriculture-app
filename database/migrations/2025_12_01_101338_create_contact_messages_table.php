<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('subject');
            $table->string('email');
            $table->string('phone');
            $table->text('message');

            $table->timestamp('terms_accepted_time');

            // Only these extra details
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            // Admin reply system
            $table->boolean('is_replied')->default(0);
            $table->text('reply_message')->nullable();
            $table->timestamp('replied_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
