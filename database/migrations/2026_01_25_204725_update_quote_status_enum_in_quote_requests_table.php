<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->dropColumn('quote_status');
        });

        Schema::table('quote_requests', function (Blueprint $table) {
            $table->enum('quote_status', ['new', 'pending', 'converted', 'completed', 'rejected'])
                ->default('new')
                ->after('client_id');
        });

        DB::table('quote_requests')->update(['quote_status' => 'new']);
    }

    public function down(): void
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->dropColumn('quote_status');
        });

        Schema::table('quote_requests', function (Blueprint $table) {
            $table->enum('quote_status', ['pending', 'converted', 'rejected'])
                ->default('pending')
                ->after('client_id');
        });
    }
};
