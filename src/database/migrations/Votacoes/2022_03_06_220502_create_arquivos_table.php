<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sufragioId')->index('arquivos_sufragioId_foreign');
            $table->string('label', 50)->unique('arquivos_label_idx');
            $table->string('filename')->unique('arquivos_filename_idx');
            $table->string('mimeType', 60);
            $table->string('extension', 8);
            $table->integer('size')->comment('Bytes');
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->timestamp('deletedAt')->nullable();
            $table->unique(['sufragioId', 'filename']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
}
