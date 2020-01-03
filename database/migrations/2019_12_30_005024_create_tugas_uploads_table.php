<?php
//BELUM DI-MIGRATE
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_upload', function (Blueprint $table) {
            $table->increments('upload_id');
            $table->integer('tugas_id')->unsigned();
            $table->foreign('tugas_id')->references('tugas_id')->on('tugas');
            $table->integer('siswa_id')->unsigned();
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->string('upload_file');
            $table->integer('upload_nilai')->nullable();
            $table->string('upload_komentar')->nullable();
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
        Schema::dropIfExists('tugas_upload');
    }
}
