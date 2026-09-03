<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id', 20)->unique();
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->string('id_number', 50)->nullable();
            $table->text('address')->nullable();
            $table->decimal('address_lat', 10, 8)->nullable();
            $table->decimal('address_lng', 11, 8)->nullable();
            $table->enum('status', ['LEAD', 'PROSPECT', 'ACTIVE', 'SUSPENDED', 'TERMINATED'])->default('LEAD');
            $table->timestamps();

            $table->index('status');
            $table->index('customer_id');
            $table->index('phone');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_id', 20)->unique();
            $table->string('name');
            $table->integer('speed_down')->comment('Mbps');
            $table->integer('speed_up')->comment('Mbps');
            $table->decimal('price_monthly', 12, 2);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);

            $table->index('is_active');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_id', 20)->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->enum('status', ['PENDING', 'ACTIVE', 'SUSPENDED', 'TERMINATED'])->default('PENDING');
            $table->date('install_date')->nullable();
            $table->date('activation_date')->nullable();
            $table->date('suspension_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('pppoe_username', 50)->nullable();
            $table->string('pppoe_password')->nullable();
            $table->string('assigned_ip', 15)->nullable();
            $table->integer('vlan_id')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');

            $table->index('customer_id');
            $table->index('status');
            $table->index('package_id');
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id', 20)->unique();
            $table->string('full_name')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('source', 50)->nullable()->comment('Ads, Referral, Organic, etc.');
            $table->enum('status', ['NEW', 'QUALIFIED', 'CONTACTED', 'CONVERTED', 'LOST'])->default('NEW');
            $table->integer('lead_score')->default(0);
            $table->timestamps();

            $table->index('status');
        });

        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id', 20)->unique();
            $table->string('name')->nullable();
            $table->string('channel', 50)->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->decimal('cost_spent', 12, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['DRAFT', 'ACTIVE', 'PAUSED', 'COMPLETED'])->default('DRAFT');

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('services');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('customers');
    }
};
