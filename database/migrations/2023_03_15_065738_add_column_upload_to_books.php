<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUploadToBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('volume')->nullable()->after('edition');
            $table->integer('upload')->default('1')->after('issuer');
            // $table->unsignedBigInteger('author_id')->default(0);
            $table->unsignedBigInteger('author_id')->default(0)->after('author');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            // $table->unsignedBigInteger('publisher_id')->default(0);
            $table->unsignedBigInteger('publisher_id')->default(0)->after('publisher');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('upload');
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
            $table->dropForeign(['publisher_id']);
            $table->dropColumn('publisher_id');
        });
    }
}
