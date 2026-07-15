<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'astpp';

    public function up(): void
    {
        if (! Schema::connection('astpp')->hasTable('billing_transactions')) {
            return;
        }

        DB::connection('astpp')->statement(
            'ALTER TABLE billing_transactions
             MODIFY reference_id VARCHAR(191) NULL'
        );
    }

    public function down(): void
    {
        if (! Schema::connection('astpp')->hasTable('billing_transactions')) {
            return;
        }

        DB::connection('astpp')->statement(
            'ALTER TABLE billing_transactions
             MODIFY reference_id BIGINT NULL'
        );
    }
};
