<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnModifyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'cannang_from'))
                $table->unsignedFloat('cannang_from')->default(0);
            
            if (!Schema::hasColumn('users', 'cannang_to'))
                $table->unsignedFloat('cannang_to')->default(0);
            
            if (!Schema::hasColumn('users', 'caloonday'))
                $table->unsignedFloat('caloonday')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
}
