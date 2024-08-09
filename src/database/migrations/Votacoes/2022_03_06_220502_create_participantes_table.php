<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sufragioId')->index('participantes_sufragioId_foreign');
            $table->string('cpf', 11)->index('participantes_cpf_idx');
            $table->string('ip', 45);
            $table->dateTime('votouEm');
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('updatedAt')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->timestamp('deletedAt')->nullable();
            $table->unique(['sufragioId', 'cpf']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participantes');
    }
}
