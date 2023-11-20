<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_id')->nullable()->constrained('customers_policies');
            $table->foreignId('companypolicy_id')->nullable()->constrained('companies_policies');
            $table->decimal('service_tax', 10, 2)->default(0.00);
            $table->decimal('stamp_duty', 10, 2)->default(0.00);          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
