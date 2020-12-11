<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedSchedulesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'assigned_schedules';

    /**
     * Run the migrations.
     * @table assigned_schedules
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_userCDU')->nullable()->default(null);
            $table->unsignedBigInteger('id_schedules')->nullable()->default(null);
            $table->timestamp('expiration_date')->nullable()->default(null);
            $table->float('amount')->nullable()->default('1');

            $table->index(["id_userCDU"], 'id_userCDU');

            $table->index(["id_schedules"], 'id_schedules');
            $table->nullableTimestamps();


            $table->foreign('id_userCDU', 'id_userCDU_schedules')
                ->references('id')->on('users_cdu')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_schedules', 'id_schedules')
                ->references('id')->on('schedules')
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
