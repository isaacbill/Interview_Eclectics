<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
            Schema::create('loan_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id')->constrained();
                $table->foreignId('loan_product_id')->constrained();
                $table->decimal('requested_amount', 15, 2);
                $table->decimal('amount_disbursed', 15, 2)->nullable();
                $table->decimal('amount_repaid', 15, 2)->nullable();
                $table->enum('status', ['pending', 'approved', 'rejected', 'repaid'])->default('pending'); // Add 'repaid' status
                $table->timestamp('disbursed_at')->nullable(); // For storing the disbursement date
                $table->timestamp('repaid_at')->nullable(); // For storing the repayment date
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
};
