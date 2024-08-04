<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('fees', 10, 2)->default(0);
            $table->unsignedInteger('fees_duration')->default(0);
            $table->integer('no_of_code_per_page')->default(65);
            $table->integer('no_of_qrcode_per_page')->default(24);
            $table->integer('no_of_books_per_member')->default(3);
            $table->integer('no_of_days_for_lending')->default(7);
            $table->string('hostname', 300)->nullable();
            $table->string('id_code_prefix')->default('RL');
            $table->integer('id_capacity')->default('3');
            $table->string('id_address_default', 255)->nullable()->default('Ramthar Veng, Aizawl, Mizoram');
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
        Schema::dropIfExists('settings');
    }
}
