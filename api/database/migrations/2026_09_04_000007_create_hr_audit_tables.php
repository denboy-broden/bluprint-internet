<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 20)->unique();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('role', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('status', ['ACTIVE', 'ON_LEAVE', 'TERMINATED'])->default('ACTIVE');
            $table->timestamps();

            $table->index('department');
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('audit_id', 30)->unique();
            $table->timestamp('timestamp')->useCurrent();
            $table->enum('actor_type', ['AI', 'HUMAN', 'SYSTEM']);
            $table->string('actor_id', 50);
            $table->string('action', 100);
            $table->string('target_type', 50)->nullable();
            $table->string('target_id', 50)->nullable();
            $table->string('domain', 50)->nullable();
            $table->enum('risk_level', ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL'])->default('LOW');
            $table->json('before_state')->nullable();
            $table->json('after_state')->nullable();
            $table->string('reason')->nullable();
            $table->string('approval_id', 30)->nullable();
            $table->enum('result', ['SUCCESS', 'FAILURE', 'PENDING'])->default('SUCCESS');
            $table->text('details')->nullable();

            $table->index('actor_id');
            $table->index('action');
            $table->index('timestamp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('employees');
    }
};
