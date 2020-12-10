<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCduTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users_cdu';

    /**
     * Run the migrations.
     * @table users_cdu
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('username', 100)->nullable()->default(null);
            $table->string('pic', 100)->nullable()->default(null);
            $table->string('code', 20)->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->string('phone', 16)->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->float('amount')->nullable()->default('0');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);

            $table->index(["user_id"], 'user_id_index');


            $table->foreign('user_id', 'user_id_index')
                ->references('id')->on('users')
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
