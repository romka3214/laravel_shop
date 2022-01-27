<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders',function(Blueprint $table){
            $table -> id();
            $table -> enum('delivery', ['Почта России', 'СДЭК', 'СберЛогистика-Постамат', 'СберЛогистика-Курьер']);
            $table -> enum('pay_method', ['Картой-онлайн', 'Картой-курьеру', 'Наличные']);
            $table -> string('address');
            $table->integer('status');
            $table->integer('cost');
            $table->bigInteger('user_id')->index();
            $table -> string('comment');
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
