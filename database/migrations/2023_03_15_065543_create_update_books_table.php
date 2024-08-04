<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bookid');
            $table->string('title');
            $table->string('author');
            $table->string('edition')->nullable();
            $table->string('volume')->nullable();
            $table->string('year')->nullable();
            $table->string('publisher')->nullable();
            $table->string('pages')->nullable();
            $table->string('accessionno')->nullable();
            $table->string('classificationno')->nullable();
            $table->string('subject')->nullable();
            $table->string('bookno')->nullable();
            $table->text('description')->nullable();
            $table->string('price')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('member_id')->default(0);
            $table->string('issuer')->nullable();
            $table->integer('del')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_books');
    }
}
