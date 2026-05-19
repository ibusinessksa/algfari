<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fund_profile', function (Blueprint $table) {
            $table->id();
            $table->json('about')->nullable();
            $table->json('vision')->nullable();
            $table->json('mission')->nullable();
            $table->json('goals')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fund_profile');
    }
};
