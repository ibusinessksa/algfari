<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('email');
            $table->text('device_token')->nullable()->after('gender');
            $table->string('platform')->nullable()->after('device_token');
        });
    }

    public function down(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            $table->dropColumn(['gender', 'device_token', 'platform']);
        });
    }
};
