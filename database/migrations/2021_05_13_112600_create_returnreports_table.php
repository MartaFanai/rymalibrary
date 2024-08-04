<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Returnreports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->nullable(false);
            $table->foreign('book_id')->references('id')->on('books');
            $table->unsignedInteger('member_id')->nullable(false);
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('issue_users')->nullable(false);
            $table->string('return_users')->nullable(false);
            $table->dateTime('issueDate')->nullable(false);
            $table->dateTime('retDate')->nullable(false);
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
        Schema::dropIfExists('Returnreports');
    }
}
