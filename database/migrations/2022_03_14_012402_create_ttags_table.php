<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttags', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('descripcion');
            $table->string('operacion');
            $table->string('ubicacion');
            $table->string('ct');
            $table->string('planta');
            $table->string('area');
            $table->string('foto');
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
        Schema::dropIfExists('ttags');
    }
};
