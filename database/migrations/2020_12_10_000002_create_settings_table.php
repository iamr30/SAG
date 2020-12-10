<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'settings';

    /**
     * Run the migrations.
     * @table settings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key');
            $table->string('display_name');
            $table->text('value')->nullable()->default(null);
            $table->text('details')->nullable()->default(null);
            $table->string('type');
            $table->integer('order')->default('1');
            $table->string('group')->nullable()->default(null);

            $table->unique(["key"], 'settings_key_unique');
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
