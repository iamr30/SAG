<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'cards';

    /**
     * Run the migrations.
     * @table cards
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('id_card', 100)->nullable()->default(null);
            $table->bigInteger('id_userCDU')->nullable()->default(null);

            $table->index(["id_userCDU"], 'id_userCDU');
            $table->nullableTimestamps();


            $table->foreign('id_userCDU', 'id_userCDU')
                ->references('id')->on('users_cdu')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
