<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFnameToRelationInMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            DB::statement('ALTER TABLE members CHANGE COLUMN fname relation VARCHAR(255)');
            DB::statement('ALTER TABLE members MODIFY COLUMN mname VARCHAR(255) NULL');

            DB::statement("UPDATE members SET mname = relation WHERE relation NOT IN ('n/a', '.') AND mname != relation");
            DB::statement("UPDATE members SET relation = NULL, mname = NULL WHERE relation = 'n/a' AND mname = 'n/a'");

            DB::statement("UPDATE members SET relation = CASE
                WHEN gender = 'Male' THEN 'S/o'
                WHEN gender = 'Female' THEN 'D/o'
                ELSE relation
            END WHERE relation NOT IN ('n/a', '.')");

            DB::statement('ALTER TABLE members CHANGE COLUMN mname relationname VARCHAR(255)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            DB::statement('ALTER TABLE members CHANGE COLUMN relation fname VARCHAR(255)');
            DB::statement('ALTER TABLE members MODIFY COLUMN mname VARCHAR(255) NOT NULL');
        });
    }
}
