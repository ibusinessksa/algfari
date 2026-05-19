<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->json('title')->nullable(false)->change();
            $table->json('description')->nullable(false)->change();
        });
    }
};
