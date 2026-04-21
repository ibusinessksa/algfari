<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('region_id')->nullable()->after('city_id')->constrained('regions')->nullOnDelete();
        });

        if (Schema::hasColumn('users', 'city_id')) {
            DB::table('users')
                ->whereNotNull('city_id')
                ->whereNull('region_id')
                ->update([
                    'region_id' => DB::raw('(SELECT region_id FROM cities WHERE cities.id = users.city_id)'),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('region_id');
        });
    }
};
