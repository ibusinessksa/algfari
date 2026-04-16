<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_fund_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contributor_id');
            $table->decimal('amount', 12, 2);
            $table->string('transaction_type');
            $table->json('description')->nullable();
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_fund_transactions');
    }
};
