<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSufragiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sufragios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 180)->unique('sufragios_nome_UNIQUE');
            $table->string('subtitulo', 255)->nullable();
            $table->text('descricao')->nullable();
            $table->dateTime('inicio');
            $table->dateTime('fim');
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->timestamp('deletedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sufragios');
    }
}
