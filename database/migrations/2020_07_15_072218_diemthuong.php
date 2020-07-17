<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Diemthuong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diemthuong', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('card')->nullable();
            $table->unsignedInteger('value_card')->default(0)->nullable();
            $table->unsignedInteger('status')->default(0)->nullable();
            $table->text('answer')->nullable();
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
        Schema::dropIfExists('diemthuong');
    }
}
