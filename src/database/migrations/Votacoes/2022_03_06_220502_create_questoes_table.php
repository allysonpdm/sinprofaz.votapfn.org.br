<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sufragioId')->index('questoes_sufragioId_foreign');
            $table->string('label', 255)->index('questoes_label_idx');
            $table->text('complemento')->nullable();
            $table->integer('limiteEscolhas')->default(1);
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->timestamp('deletedAt')->nullable();
            $table->unique([
                'sufragioId',
                'label'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questoes');
    }
}
