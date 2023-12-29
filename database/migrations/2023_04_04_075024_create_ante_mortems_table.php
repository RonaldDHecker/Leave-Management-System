<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnteMortemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ante_mortems', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('compassionate_t_o_id');
            $table->string('reason');
            $table->string('immediate_family_member');
            $table->string('doc_cert');
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
        Schema::dropIfExists('ante_mortems');
    }
}
