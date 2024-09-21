<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRestricoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restricoes', function (Blueprint $table) {
            $table->foreign(['sufragioId'], 'restricoes_sufragioId_foreign')
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
        Schema::table('restricoes', function (Blueprint $table) {
            $table->dropForeign('restricoes_sufragioId_foreign');
        });
    }
}
