<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'payments';

    /**
     * Run the migrations.
     * @table payments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('id_userCDU')->nullable()->default(null);
            $table->string('reference')->nullable()->default(null);
            $table->string('comments')->nullable()->default(null);
            $table->dateTime('expiration_date')->nullable()->default(null);
            $table->float('amount');
            $table->unsignedBigInteger('id_assigned');

            $table->index(["id_userCDU"], 'id_userCDU');

            $table->index(["id_assigned"], 'id_assigned');
            $table->nullableTimestamps();


            $table->foreign('id_assigned', 'id_assigned')
                ->references('id')->on('assigned_schedules')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_userCDU', 'id_userCDU')
                ->references('id')->on('users_cdu')
                ->onDelete('cascade')
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
