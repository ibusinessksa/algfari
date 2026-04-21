<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['city', 'region']);
            $table->foreignId('city_id')->nullable()->after('current_job')->constrained()->nullOnDelete();
        });

        Schema::table('join_requests', function (Blueprint $table) {
            $table->dropColumn(['city', 'region']);
            $table->foreignId('city_id')->nullable()->after('email')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('city_id');
            $table->string('city', 100)->nullable();
            $table->string('region', 100)->nullable();
        });

        Schema::table('join_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('city_id');
            $table->string('city', 100)->nullable();
            $table->string('region', 100)->nullable();
        });
    }
};
