<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id', 20)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->decimal('amount_subtotal', 12, 2)->default(0);
            $table->decimal('amount_discount', 12, 2)->default(0);
            $table->decimal('amount_tax', 12, 2)->default(0);
            $table->decimal('amount_total', 12, 2)->default(0);
            $table->enum('status', ['DRAFT', 'ISSUED', 'PAID', 'OVERDUE', 'SUSPENDED', 'CANCELLED'])->default('DRAFT');
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict');

            $table->index('customer_id');
            $table->index('due_date');
            $table->index('status');
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->string('description');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 12, 2);
            $table->decimal('amount', 12, 2);

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->index('invoice_id');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id', 20)->unique();
            $table->unsignedBigInteger('invoice_id');
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['CASH', 'BANK_TRANSFER', 'WALLET']);
            $table->enum('status', ['PENDING', 'COMPLETED', 'FAILED'])->default('PENDING');
            $table->timestamp('paid_at')->nullable();
            $table->string('gateway_ref', 100)->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('restrict');

            $table->index('invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
};
