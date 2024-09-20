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
    Schema::table('loan_applications', function (Blueprint $table) {
        $table->decimal('amount_disbursed', 10, 2)->nullable()->default(0);
        $table->decimal('amount_repaid', 10, 2)->nullable()->default(0);
    });
}

public function down()
{
    Schema::table('loan_applications', function (Blueprint $table) {
        $table->dropColumn(['amount_disbursed', 'amount_repaid']);
    });
}
  
};
