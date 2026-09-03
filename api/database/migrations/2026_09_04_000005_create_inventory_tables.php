<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 20)->unique();
            $table->string('name');
            $table->enum('category', ['ONT', 'CABLE', 'ACCESSORY', 'OTHER'])->default('OTHER');
            $table->text('description')->nullable();
            $table->string('unit', 20)->nullable();
            $table->decimal('price_unit', 12, 2)->nullable();
        });

        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_id', 20)->unique();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['ACTIVE', 'CLOSED'])->default('ACTIVE');
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('minimum_level')->default(10);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');

            $table->index('product_id');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id', 20)->unique();
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
        });

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_id', 20)->unique();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->enum('status', ['DRAFT', 'APPROVED', 'SENT', 'RECEIVED', 'CLOSED'])->default('DRAFT');
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->string('approval_by', 50)->nullable();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');

            $table->index('status');
        });

        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id', 20)->unique();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->date('assigned_date')->nullable();
            $table->enum('status', ['DEPLOYED', 'IN_STOCK', 'MAINTENANCE', 'DECOMMISSIONED'])->default('IN_STOCK');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');

            $table->index('customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('stock');
        Schema::dropIfExists('warehouses');
        Schema::dropIfExists('products');
    }
};
