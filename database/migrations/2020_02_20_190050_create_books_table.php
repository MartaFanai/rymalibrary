<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500);
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->string('edition')->nullable();
            $table->string('volume')->nullable();
            $table->string('year')->nullable();
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->string('pages')->nullable();
            $table->string('accessionno')->nullable();
            $table->string('classificationno')->nullable();
            $table->string('subject', 500)->nullable();
            $table->string('bookno')->nullable();
            $table->text('description', 500)->nullable();
            $table->string('price')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedInteger('member_id')->default(0);
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('issuer')->nullable();
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
        Schema::dropIfExists('books');
    }
}
