<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilialObligationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filial_obligations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('compassionate_t_o_id');
            $table->string('reason');
            $table->string('name_of_parent')->nullable();
            $table->string('name_of_sibling')->nullable();
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
        Schema::dropIfExists('filial_obligations');
    }
}
