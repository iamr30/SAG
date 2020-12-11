<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'schedules';

    /**
     * Run the migrations.
     * @table schedules
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_course')->nullable()->default(null);
            $table->unsignedBigInteger('id_instructor')->nullable()->default(null);
            $table->string('m', 50)->nullable()->default(null);
            $table->string('t', 50)->nullable()->default(null);
            $table->string('w', 50)->nullable()->default(null);
            $table->string('r', 50)->nullable()->default(null);
            $table->string('f', 50)->nullable()->default(null);
            $table->string('s', 50)->nullable()->default(null);
            $table->integer('capacity')->nullable()->default(null);

            $table->index(["id_course"], 'id_course');

            $table->index(["id_instructor"], 'id_instructor');


            $table->foreign('id_course', 'id_course')
                ->references('id')->on('courses')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_instructor', 'id_instructor')
                ->references('id')->on('instructors')
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
