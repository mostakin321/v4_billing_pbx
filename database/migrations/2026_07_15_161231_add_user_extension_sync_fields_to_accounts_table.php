<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'astpp';

    public function up(): void
    {
        $schema = Schema::connection('astpp');

        if (! $schema->hasColumn('accounts', 'fusion_user_uuid')) {
            $schema->table('accounts', function (Blueprint $table): void {
                $table->string('fusion_user_uuid', 36)->nullable()->index();
            });
        }

        if (! $schema->hasColumn('accounts', 'extension_uuid')) {
            $schema->table('accounts', function (Blueprint $table): void {
                $table->string('extension_uuid', 36)->nullable()->index();
            });
        }

        if (! $schema->hasColumn('accounts', 'domain_uuid')) {
            $schema->table('accounts', function (Blueprint $table): void {
                $table->string('domain_uuid', 36)->nullable()->index();
            });
        }
    }

    public function down(): void
    {
        $schema = Schema::connection('astpp');

        foreach (['fusion_user_uuid', 'extension_uuid', 'domain_uuid'] as $column) {
            if ($schema->hasColumn('accounts', $column)) {
                $schema->table('accounts', function (Blueprint $table) use ($column): void {
                    $table->dropColumn($column);
                });
            }
        }
    }
};
