<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function($table){        //Tabel aanmaken met de naam "movies"
            $table->integer('user_id');                 //Bevat kolom met de naam user_id en bestaat uit integers.
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
            $table->dropColumn('user_id');              //Delete de kolom.
        });

                                                        /*Drop the migration's door Terminal op te starten.
                                                        php artisan migrate rollback zorgt ervoor dat de kolom 
                                                        uit phpmyadmin gehaald word. */
    }
}
