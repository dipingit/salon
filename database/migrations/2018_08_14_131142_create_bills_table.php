<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('customer_id')->index();
            $table->string('service_id')->nullable();
            $table->string('invoice')->nullable();
            $table->string('token')->nullable();
            $table->double('discount')->nullable();
            $table->double('amount')->nullable();
            $table->double('vat')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
