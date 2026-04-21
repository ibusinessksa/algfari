<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            $table->foreignId('region_id')->nullable()->after('email')->constrained('regions')->nullOnDelete();
        });

        if (Schema::hasColumn('join_requests', 'city_id')) {
            $rows = DB::table('join_requests')->whereNotNull('city_id')->get(['id', 'city_id']);
            foreach ($rows as $row) {
                $regionId = DB::table('cities')->where('id', $row->city_id)->value('region_id');
                if ($regionId !== null) {
                    DB::table('join_requests')->where('id', $row->id)->update(['region_id' => $regionId]);
                }
            }

            Schema::table('join_requests', function (Blueprint $table) {
                $table->dropConstrainedForeignId('city_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('join_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('region_id');
        });

        Schema::table('join_requests', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('email')->constrained()->nullOnDelete();
        });
    }
};
