<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Run ONLY if billing_transactions table doesn't exist.
 * Check first: DESCRIBE billing_transactions;
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('billing_transactions')) {
            Schema::create('billing_transactions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('account_id')->index();
                $table->unsignedBigInteger('cdr_id')->nullable()->index();
                $table->string('type', 50)->default('topup'); // topup, credit, call, did, adjustment, refund
                $table->decimal('amount', 20, 5)->default(0);
                $table->decimal('balance_before', 20, 5)->default(0);
                $table->decimal('balance_after', 20, 5)->default(0);
                $table->string('description', 500)->nullable();
                $table->string('reference_type', 50)->nullable();
                $table->unsignedBigInteger('reference_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->index(['account_id', 'created_at']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_transactions');
    }
};
