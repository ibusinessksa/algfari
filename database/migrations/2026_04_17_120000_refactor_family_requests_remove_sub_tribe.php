<?php

use App\Models\Family;
use App\Support\FamilyNameNormalizer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('family_proposals');

        Schema::create('family_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('status')->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('resolved_family_id')->nullable()->constrained('families')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });

        Schema::table('families', function (Blueprint $table) {
            $table->string('normalized_name')->nullable()->after('name');
        });

        foreach (Family::query()->cursor() as $family) {
            $normalized = FamilyNameNormalizer::normalize($family->name);
            DB::table('families')->where('id', $family->id)->update(['normalized_name' => $normalized]);
        }

        Schema::table('families', function (Blueprint $table) {
            $table->unique('normalized_name');
        });

        if (Schema::hasColumn('users', 'sub_tribe')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('sub_tribe');
            });
        }

        if (Schema::hasColumn('users', 'pending_family_origin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('pending_family_origin');
            });
        }

        if (Schema::hasColumn('join_requests', 'sub_tribe')) {
            Schema::table('join_requests', function (Blueprint $table) {
                $table->dropColumn('sub_tribe');
            });
        }
    }

    public function down(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->dropUnique(['normalized_name']);
            $table->dropColumn('normalized_name');
        });

        Schema::dropIfExists('family_requests');

        Schema::create('family_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('origin')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('resulting_family_id')->nullable()->constrained('families')->nullOnDelete();
            $table->timestamps();
            $table->index(['status', 'created_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('sub_tribe', 100)->nullable()->after('password');
            $table->string('pending_family_origin', 255)->nullable()->after('pending_family_name');
        });

        Schema::table('join_requests', function (Blueprint $table) {
            $table->string('sub_tribe', 100)->nullable();
        });
    }
};
