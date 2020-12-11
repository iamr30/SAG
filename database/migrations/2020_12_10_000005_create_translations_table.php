<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'translations';

    /**
     * Run the migrations.
     * @table translations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('table_name');
            $table->string('column_name');
            $table->unsignedInteger('foreign_key');
            $table->string('locale');
            $table->text('value');

            $table->unique(["table_name", "column_name", "foreign_key", "locale"], 'translations_table_name_column_name_foreign_key_locale_unique');
            $table->nullableTimestamps();
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
