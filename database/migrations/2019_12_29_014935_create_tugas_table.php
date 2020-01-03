<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->increments('tugas_id');
            $table->integer('mapel_assoc_id')->unsigned();
            $table->foreign('mapel_assoc_id')->references('id')->on('mapel_association');
            $table->string('tugas_judul');
            $table->text('tugas_deskripsi');
            $table->dateTime('tugas_deadline');

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
        Schema::dropIfExists('tugas');
    }
}
