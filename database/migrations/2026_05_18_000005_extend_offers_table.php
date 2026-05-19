<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('partner_type')->default('family')->after('category');
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->foreignId('region_id')->nullable()->after('service_address')
                ->constrained('regions')->nullOnDelete();
            $table->string('partner_name')->nullable()->after('partner_type');
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['partner_type', 'is_featured', 'region_id', 'partner_name']);
        });
    }
};
