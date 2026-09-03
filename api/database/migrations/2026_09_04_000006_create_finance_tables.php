<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_id', 20)->unique();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('account_name')->nullable();
            $table->decimal('balance', 12, 2)->default(0);
            $table->string('currency', 3)->default('IDR');
            $table->enum('status', ['ACTIVE', 'CLOSED'])->default('ACTIVE');
        });

        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id', 20)->unique();
            $table->enum('type', ['INCOME', 'EXPENSE', 'TRANSFER']);
            $table->decimal('amount', 12, 2);
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('created_by', 50)->nullable();

            $table->index('type');
        });

        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 20)->unique();
            $table->string('account_name')->nullable();
            $table->enum('category', ['ASSET', 'LIABILITY', 'EQUITY', 'REVENUE', 'EXPENSE']);
            $table->string('parent_code', 20)->nullable();
            $table->boolean('is_active')->default(true);
        });

        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('entry_id', 20)->unique();
            $table->date('entry_date');
            $table->string('description')->nullable();
            $table->string('reference', 100)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('approved_by', 50)->nullable();
            $table->enum('status', ['DRAFT', 'POSTED', 'REVERSED'])->default('DRAFT');

            $table->index('entry_date');
        });

        Schema::create('journal_line_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entry_id');
            $table->string('account_code', 20);
            $table->decimal('debit', 12, 2)->default(0);
            $table->decimal('credit', 12, 2)->default(0);

            $table->foreign('entry_id')->references('id')->on('journal_entries')->onDelete('cascade');
            $table->foreign('account_code')->references('account_code')->on('chart_of_accounts');

            $table->index('entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_line_items');
        Schema::dropIfExists('journal_entries');
        Schema::dropIfExists('chart_of_accounts');
        Schema::dropIfExists('cash_transactions');
        Schema::dropIfExists('bank_accounts');
    }
};
