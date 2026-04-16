<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('is_urgent')->default(false)->after('is_pinned');
            $table->time('time_from')->nullable()->after('published_at');
            $table->time('time_to')->nullable()->after('time_from');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['is_urgent', 'time_from', 'time_to']);
        });
    }
};
