<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn([
                'summary',
                'category',
                'is_pinned',
                'views_count',
                'author_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->json('summary')->nullable()->after('content');
            $table->string('category')->after('summary');
            $table->boolean('is_pinned')->default(false)->after('category');
            $table->unsignedInteger('views_count')->default(0)->after('is_pinned');
            $table->foreignId('author_id')->after('views_count');
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
