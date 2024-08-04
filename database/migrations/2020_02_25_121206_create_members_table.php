<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('relation')->nullable();
            $table->string('relationname', 255)->nullable();
            $table->string('gender')->default('nil');
            $table->string('section')->nullable();
            $table->string('mobile');
            $table->text('address', 300)->nullable(); 
            $table->string('image')->default('unknown.jpg');
            $table->string('id_number')->default(0);
            $table->string('rid')->default(0);
            $table->string('year')->nullable();
            $table->decimal('rating', 4,2)->default(0);
            $table->string('rating_user')->nullable();
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
        Schema::dropIfExists('members');
    }
}
