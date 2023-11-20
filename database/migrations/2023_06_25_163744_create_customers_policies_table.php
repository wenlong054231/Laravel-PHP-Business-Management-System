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
        Schema::create('customers_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->decimal('coverage', 10, 2)->default(0.00);;
            $table->string('insurance_type');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('car_plate')->nullable();
            $table->date('expired_date');
            $table->date('registered_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_policies');
    }
};
