<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('loans', 'member_id')) {
            Schema::table('loans', function (Blueprint $table) {
                $table->foreignId('member_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('members');
            });
        }

        if (Schema::hasTable('loans_items') && ! Schema::hasTable('loan_items')) {
            Schema::rename('loans_items', 'loan_items');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('loans', 'member_id')) {
            Schema::table('loans', function (Blueprint $table) {
                $table->dropConstrainedForeignId('member_id');
            });
        }

        if (Schema::hasTable('loan_items') && ! Schema::hasTable('loans_items')) {
            Schema::rename('loan_items', 'loans_items');
        }
    }
};
