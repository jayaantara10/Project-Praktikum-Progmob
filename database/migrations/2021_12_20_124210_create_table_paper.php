<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("judul");
            $table->string("jenis");
            $table->string("penulis");
            $table->string("link");
            $table->string("lisensi");
            $table->string("batasan_umur");
            $table->string("deskripsi");
            $table->timestamps();
            $table->integer("id_user");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper');
    }
}
