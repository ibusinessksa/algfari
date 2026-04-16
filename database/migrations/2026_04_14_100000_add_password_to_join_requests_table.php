<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('join_requests', 'password')) {
                $table->string('password')->nullable()->after('region');
            }
        });
    }

    public function down(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            if (Schema::hasColumn('join_requests', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};
