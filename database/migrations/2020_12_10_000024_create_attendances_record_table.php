<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesRecordTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'attendances_record';

    /**
     * Run the migrations.
     * @table attendances_record
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('id_userscdu')->nullable()->default(null);
            $table->timestamp('date')->nullable()->default(null);

            $table->index(["id_userscdu"], 'users_cdu');
            $table->nullableTimestamps();


            $table->foreign('id_userscdu', 'users_cdu')
                ->references('id')->on('users_cdu')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
