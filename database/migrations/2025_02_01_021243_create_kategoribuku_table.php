<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoribukuTable extends Migration
{
    public function up()
    {
        Schema::create('kategoribuku', function (Blueprint $table) {
            $table->id('KategoriID');
            $table->string('NamaKategori', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategoribuku');
    }
}
