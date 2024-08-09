<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToQuestoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questoes', function (Blueprint $table) {
            $table->foreign(['sufragioId'], 'questoes_sufragioId_foreign')
                ->references(['id'])
                ->on('sufragios')
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
        Schema::table('questoes', function (Blueprint $table) {
            $table->dropForeign('questoes_sufragioId_foreign');
        });
    }
}
