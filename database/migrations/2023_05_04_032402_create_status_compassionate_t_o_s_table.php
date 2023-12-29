<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusCompassionateTOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_compassionate_t_o_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('compassionate_t_o_id');
            $table->string('admin')->default('pending');
            $table->string('head')->default('pending');
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
        Schema::dropIfExists('status_compassionate_t_o_s');
    }
}
