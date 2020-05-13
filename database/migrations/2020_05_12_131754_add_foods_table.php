<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thucphams', function (Blueprint $table) {
            $table->id();
            $table->text('tensp');
            $table->unsignedDouble('nangluong');
            $table->unsignedDouble('chatbeo');
            $table->unsignedDouble('chatxo');
            $table->unsignedDouble('duong');
            $table->unsignedDouble('vitamina');
            $table->unsignedDouble('vitaminc');
            $table->unsignedDouble('canxi');
            $table->unsignedDouble('sat');
            $table->unsignedDouble('giamcan');
            $table->unsignedDouble('suckhoe');
            $table->unsignedDouble('tangcan');
            $table->unsignedDouble('caloriefromprotein');
            $table->unsignedDouble('caloriefromcarb');
            $table->unsignedDouble('caloriefromfat');
            $table->text('uudiem');
            $table->text('khuyetdiem');
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
        Schema::dropIfExists('thucphams');
    }
}
