<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Run ONLY if billing_cdrs table doesn't exist.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('billing_cdrs')) {
            Schema::create('billing_cdrs', function (Blueprint $table) {
                $table->id();
                $table->string('uuid', 64)->nullable()->index();
                $table->unsignedBigInteger('account_id')->index();
                $table->string('account_number', 50)->nullable()->index();
                $table->unsignedBigInteger('reseller_id')->default(0);
                $table->unsignedBigInteger('trunk_id')->nullable();
                $table->string('caller_number', 50)->nullable();
                $table->string('destination_number', 50)->nullable()->index();
                $table->enum('call_direction', ['inbound','outbound'])->default('outbound');
                $table->datetime('start_time')->nullable();
                $table->datetime('answer_time')->nullable();
                $table->datetime('end_time')->nullable();
                $table->integer('duration')->default(0);
                $table->integer('billsec')->default(0);
                $table->integer('billed_seconds')->default(0);
                $table->decimal('rate', 20, 5)->default(0);
                $table->decimal('sell_rate', 20, 5)->default(0);
                $table->decimal('buy_rate', 20, 5)->default(0);
                $table->decimal('call_cost', 20, 5)->default(0);
                $table->decimal('connect_cost', 20, 5)->default(0);
                $table->decimal('reseller_cost', 20, 5)->default(0);
                $table->integer('init_inc')->default(60);
                $table->integer('inc')->default(1);
                $table->unsignedBigInteger('pricelist_id')->nullable();
                $table->decimal('nibble_total', 20, 5)->default(0);
                $table->string('status', 20)->nullable();
                $table->string('hangup_cause', 50)->nullable();
                $table->string('bill_status', 20)->nullable();
                $table->unsignedBigInteger('did_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->index(['account_id', 'start_time']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_cdrs');
    }
};
