<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migration
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('slug', 150);
            $table->text('description');
            $table->integer('pages', false, true);
        });
    }

    /**
     * Rollback the migration
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
