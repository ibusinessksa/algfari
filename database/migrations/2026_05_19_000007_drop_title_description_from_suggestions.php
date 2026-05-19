<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            if (Schema::hasColumn('suggestions', 'title')) {
                $table->dropColumn('title');
            }
            if (Schema::hasColumn('suggestions', 'description')) {
                $table->dropColumn('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->json('title')->nullable()->after('id');
            $table->json('description')->nullable()->after('title');
        });
    }
};
