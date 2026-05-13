<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['member_sons', 'member_daughters'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('gender')->nullable()->after('name');
                $table->date('birthday')->nullable()->after('gender');
            });
        }
    }

    public function down(): void
    {
        foreach (['member_sons', 'member_daughters'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn(['gender', 'birthday']);
            });
        }
    }
};
