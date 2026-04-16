<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('family_id')->nullable()->after('sub_tribe')->constrained()->nullOnDelete();
            $table->string('member_card_number', 50)->nullable()->after('family_id');
            $table->string('workplace', 255)->nullable()->after('member_card_number');
            $table->string('current_job', 255)->nullable()->after('workplace');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('family_id');
            $table->dropColumn(['member_card_number', 'workplace', 'current_job']);
        });
    }
};
