<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompassionateTOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compassionate_t_o_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->date('date1');
            $table->date('date2');
            $table->date('date3');
            $table->tinyInteger('leave_days');
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
        Schema::dropIfExists('compassionate_t_o_s');
    }
}
