<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_entries', function (Blueprint $table) {
            $table->id();
            $table->string('account_title');
            $table->string('uacs_code');
            $table->decimal('debit', 15, 2)->default(0);
            $table->decimal('credit', 15, 2)->default(0);
            $table->unsignedBigInteger('disbursement_voucher_id');
            $table->timestamps();

            $table->foreign('disbursement_voucher_id')
                  ->references('id')
                  ->on('disbursement_vouchers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_entries');
    }
}