<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->string('tech_id', 20)->unique();
            $table->string('full_name')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('skills')->nullable();
            $table->enum('status', ['ACTIVE', 'OFFLINE', 'ON_LEAVE'])->default('ACTIVE');
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id', 20)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->enum('category', ['TECHNICAL', 'BILLING', 'SALES', 'COMPLAINT'])->default('TECHNICAL');
            $table->enum('priority', ['P1', 'P2', 'P3', 'P4'])->default('P3');
            $table->enum('status', ['OPEN', 'IN_PROGRESS', 'WAITING', 'RESOLVED', 'CLOSED', 'REOPENED'])->default('OPEN');
            $table->string('assigned_agent', 20)->nullable();
            $table->unsignedBigInteger('assigned_tech')->nullable();
            $table->text('description')->nullable();
            $table->text('resolution_notes')->nullable();
            $table->timestamp('sla_target_at')->nullable();
            $table->boolean('sla_breach')->default(false);

            $table->foreign('assigned_tech')->references('id')->on('technicians')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');

            $table->index('customer_id');
            $table->index('priority');
        });

        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('incident_id', 20)->unique();
            $table->unsignedBigInteger('pop_id')->nullable();
            $table->unsignedBigInteger('olt_id')->nullable();
            $table->unsignedBigInteger('router_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('severity', ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL'])->default('MEDIUM');
            $table->enum('status', ['DETECTED', 'INVESTIGATING', 'RESOLVED', 'CLOSED'])->default('DETECTED');
            $table->integer('affected_customers')->default(0);
            $table->string('root_cause')->nullable();
            $table->string('recommendation')->nullable();

            $table->foreign('pop_id')->references('id')->on('pops')->onDelete('set null');

            $table->index('severity');
            $table->index('status');
        });

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_id', 20)->unique();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->enum('status', ['PENDING', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->date('scheduled_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('materials_used')->nullable();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('set null');
            $table->foreign('technician_id')->references('id')->on('technicians')->onDelete('set null');

            $table->index('technician_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
        Schema::dropIfExists('incidents');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('technicians');
    }
};
