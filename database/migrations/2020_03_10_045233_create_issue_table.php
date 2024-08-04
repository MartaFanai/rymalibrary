<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->nullable(false);
            $table->foreign('book_id')->references('id')->on('books');
            $table->unsignedInteger('member_id')->nullable(false);
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('users_name')->nullable(false);
            $table->unsignedInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('issues');
    }
}
