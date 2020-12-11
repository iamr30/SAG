<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondonationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'condonations';

    /**
     * Run the migrations.
     * @table condonations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_assigned')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('comments')->nullable()->default(null);
            $table->date('expiration_date')->nullable()->default(null);
            $table->float('percentage')->nullable()->default('0');
            $table->string('scholarship_type', 100)->nullable()->default(null);

            $table->index(["id_assigned"], 'id_assigned');

            $table->index(["user_id"], 'user_id_index');
            $table->nullableTimestamps();


            $table->foreign('id_assigned', 'id_assigned_')
                ->references('id')->on('assigned_schedules')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'user_id_index_')
                ->references('id')->on('users')
                ->onDelete('cascade')
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
