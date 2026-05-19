<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->foreignId('parent_family_id')->nullable()->after('id')
                ->constrained('families')->nullOnDelete();
            $table->unsignedSmallInteger('generation')->default(1)->after('parent_family_id');
            $table->index(['parent_family_id', 'generation']);
        });
    }

    public function down(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropIndex(['parent_family_id', 'generation']);
            $table->dropForeign(['parent_family_id']);
            $table->dropColumn(['parent_family_id', 'generation']);
        });
    }
};
