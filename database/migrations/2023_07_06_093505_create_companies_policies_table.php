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
        Schema::create('companies_policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_number')->nullable()->unique();
            $table->decimal('coverage', 10, 2)->default(0.00);;
            $table->string('insurance_type');
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
        Schema::dropIfExists('companies_policies');
    }
};
