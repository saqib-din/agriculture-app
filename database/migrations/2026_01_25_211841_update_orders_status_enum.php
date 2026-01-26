<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('orders')->where('status', 'pending')->update(['status' => 'new']);
        DB::table('orders')->where('status', 'in_progress')->update(['status' => 'processing']);
        DB::table('orders')->where('status', 'delivered')->update(['status' => 'processing']);
        DB::table('orders')->where('status', 'installed')->update(['status' => 'processing']);

        // Now modify the status column
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['new', 'processing', 'completed', 'cancelled'])
                ->default('new')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('orders')->where('status', 'new')->update(['status' => 'pending']);
        DB::table('orders')->where('status', 'processing')->update(['status' => 'in_progress']);

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'delivered', 'installed', 'completed', 'cancelled'])
                ->default('pending')
                ->change();
        });
    }
};
