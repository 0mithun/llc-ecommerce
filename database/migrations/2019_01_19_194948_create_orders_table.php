<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('customer_name', 100);
            $table->string('customer_phone_number', 32);
            $table->text('address');
            $table->string('city', 100);
            $table->string('postal_code', 32);
            $table->double('total_amount', 10, 2);
            $table->double('discount_amount', 10, 2)->default(0.00);
            $table->double('paid_amount', 10, 2);
            $table->string('payment_status', 32)->default('Pending');
            $table->text('payment_details')->nullable();
            $table->string('operational_status', 32)->default('Pending');
            $table->unsignedInteger('processed_by')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('processed_by')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
