<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number', 10)->unique();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->enum('condition', ['pending', 'processing', 'delivered', 'cancelled'])->default('pending');
            $table->float('delivery_charge')->default(0)->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->mediumText('note')->nullable();

            $table->string('s_first_name');
            $table->string('s_last_name');
            $table->string('s_email');
            $table->string('s_phone');
            $table->string('s_country')->nullable();
            $table->string('s_address');
            $table->string('s_city');
            $table->string('s_postcode')->nullable();
            $table->string('s_state')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
