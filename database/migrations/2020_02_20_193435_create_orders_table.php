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
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->string('guest_name')->nullable();
            $table->string('guest_address')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('guest_token')->nullable();
            $table->datetime('order_date')->nullable();
            $table->string('estimated_time');
            $table->string('real_time')->nullable();
            $table->enum('state', ['pending', 'finished', 'cancelled']);
            $table->boolean('paid')->default(false);
            $table->text('comment')->nullable();
            $table->string('favourite_order_name')->nullable();
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
