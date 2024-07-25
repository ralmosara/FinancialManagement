<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('disbursement_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('fund_cluster')->nullable();
            $table->string('entity_name')->nullable();
            $table->date('date')->nullable();
            $table->string('dv_no')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('payee')->nullable();
            $table->string('tin_employee_no')->nullable();
            $table->string('ors_burs_no')->nullable();
            $table->text('address')->nullable();
            $table->text('particulars')->nullable();
            $table->string('responsibility_center')->nullable();
            $table->string('mfo_pap')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_designation')->nullable();
            $table->json('accounting_entries')->nullable();
            $table->string('accounting_head_name')->nullable();
            $table->string('agency_head_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursement_vouchers');
    }
};
