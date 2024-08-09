<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respostas', function (Blueprint $table) {
            $table->foreign(['questaoId'], 'respostas_questaoId_foreign')
                ->references(['id'])
                ->on('questoes')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respostas', function (Blueprint $table) {
            $table->dropForeign('respostas_questaoId_foreign');
        });
    }
}
