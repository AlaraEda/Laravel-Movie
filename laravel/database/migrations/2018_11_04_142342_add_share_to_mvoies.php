<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShareToMvoies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function($table){        //Kolom aanmaken met de naam "users"
            $table->boolean('share')->default(0);        //Bevat kolom met de naam user_id en bestaat uit integers.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function($table){
            $table->dropColumn('share');              //Delete de kolom.
        });

    }
}
