<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('email_logs', function (Blueprint $table) {
            // Add quote_request_id support
            $table->foreignId('quote_request_id')->nullable()->after('order_id')
                ->constrained('quote_requests')->onDelete('cascade');

            // Add index
            $table->index(['quote_request_id', 'email_type']);

            // Make order_id nullable (since now we support quotes too)
            $table->foreignId('order_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('email_logs', function (Blueprint $table) {
            $table->dropForeign(['quote_request_id']);
            $table->dropIndex(['quote_request_id', 'email_type']);
            $table->dropColumn('quote_request_id');
        });
    }
};
