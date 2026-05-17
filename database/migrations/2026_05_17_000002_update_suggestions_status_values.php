<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('suggestions')->where('status', 'pending')->update(['status' => 'under_review']);
        DB::table('suggestions')->where('status', 'reviewed')->update(['status' => 'accepted']);

        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('status')->default('under_review')->change();
        });
    }

    public function down(): void
    {
        DB::table('suggestions')->whereIn('status', ['under_review', 'in_progress'])->update(['status' => 'pending']);
        DB::table('suggestions')->whereIn('status', ['accepted', 'rejected'])->update(['status' => 'reviewed']);

        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }
};
