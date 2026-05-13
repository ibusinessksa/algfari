<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('Parent member');
            $table->string('name')->nullable();
            $table->string('gender');
            $table->date('birthday')->nullable();
            $table->foreignId('linked_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['user_id', 'sort_order']);
        });

        DB::statement("INSERT INTO member_children (user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at)
            SELECT user_id, name, 'male', birthday, linked_user_id, sort_order, created_at, updated_at FROM member_sons");

        DB::statement("INSERT INTO member_children (user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at)
            SELECT user_id, name, 'female', birthday, linked_user_id, sort_order, created_at, updated_at FROM member_daughters");

        Schema::drop('member_sons');
        Schema::drop('member_daughters');
    }

    public function down(): void
    {
        Schema::create('member_sons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->foreignId('linked_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['user_id', 'sort_order']);
        });

        Schema::create('member_daughters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->foreignId('linked_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['user_id', 'sort_order']);
        });

        DB::statement("INSERT INTO member_sons (user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at)
            SELECT user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at FROM member_children WHERE gender = 'male'");

        DB::statement("INSERT INTO member_daughters (user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at)
            SELECT user_id, name, gender, birthday, linked_user_id, sort_order, created_at, updated_at FROM member_children WHERE gender = 'female'");

        Schema::drop('member_children');
    }
};
