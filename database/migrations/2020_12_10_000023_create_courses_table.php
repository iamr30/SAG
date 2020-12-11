<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'courses';

    /**
     * Run the migrations.
     * @table courses
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name')->nullable()->default(null);
            $table->unsignedBigInteger('id_discipline')->nullable()->default(null);
            $table->unsignedBigInteger('id_level')->nullable()->default(null);
            $table->date('date_start')->nullable()->default(null);
            $table->date('date_end')->nullable()->default(null);
            $table->float('cost')->nullable()->default(null);
            $table->string('reference', 50)->nullable()->default(null);

            $table->index(["id_level"], 'id_level');

            $table->index(["id_discipline"], 'id_discipline');


            $table->foreign('id_discipline', 'id_disciplines_courses')
                ->references('id')->on('disciplines')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('id_level', 'id_level')
                ->references('id')->on('levels')
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
