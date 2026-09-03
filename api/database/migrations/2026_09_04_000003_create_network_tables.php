<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pops', function (Blueprint $table) {
            $table->id();
            $table->string('pop_id', 20)->unique();
            $table->string('name')->nullable();
            $table->string('area', 100)->nullable();
            $table->text('address')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->enum('status', ['ACTIVE', 'OFFLINE', 'MAINTENANCE'])->default('ACTIVE');
            $table->timestamps();

            $table->index('area');
            $table->index('status');
        });

        Schema::create('olts', function (Blueprint $table) {
            $table->id();
            $table->string('olt_id', 20)->unique();
            $table->unsignedBigInteger('pop_id')->nullable();
            $table->string('name')->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->enum('status', ['ACTIVE', 'OFFLINE', 'MAINTENANCE'])->default('ACTIVE');
            $table->string('ip_address', 15)->nullable();
            $table->timestamps();

            $table->foreign('pop_id')->references('id')->on('pops')->onDelete('set null');

            $table->index('pop_id');
        });

        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->string('router_id', 20)->unique();
            $table->unsignedBigInteger('pop_id')->nullable();
            $table->string('name')->nullable();
            $table->string('ip_address', 15)->nullable();
            $table->string('model', 100)->nullable();
            $table->enum('status', ['ACTIVE', 'OFFLINE', 'MAINTENANCE'])->default('ACTIVE');
            $table->timestamps();

            $table->foreign('pop_id')->references('id')->on('pops')->onDelete('set null');
        });

        Schema::create('onts', function (Blueprint $table) {
            $table->id();
            $table->string('ont_id', 20)->unique();
            $table->unsignedBigInteger('olt_id')->nullable();
            $table->unsignedBigInteger('router_id')->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->string('mac_address', 17)->nullable();
            $table->enum('status', ['ACTIVE', 'OFFLINE', 'PENDING'])->default('PENDING');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('assigned_ip', 15)->nullable();
            $table->decimal('signal_dbm', 6, 2)->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');

            $table->index('customer_id');
            $table->index('olt_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onts');
        Schema::dropIfExists('routers');
        Schema::dropIfExists('olts');
        Schema::dropIfExists('pops');
    }
};
