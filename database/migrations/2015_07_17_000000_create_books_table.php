<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * @const string
     */
    const TABLE_NAME = 'book';

    /**
     * Run the migration
     */
    public function up()
    {
        if (! Schema::hasTable(self::TABLE_NAME)) {
            Schema::create(self::TABLE_NAME, function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 150);
                $table->string('slug', 150);
                $table->text('description');
                $table->integer('pages', false, true);
            });
        }
    }

    /**
     * Rollback the migration
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
