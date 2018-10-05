<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabel dat aangepast gaat worden is "posts"
        Schema::table('posts', function($table){
            //De kolom gaat heten user_id en zal gevuld worden met integers.
            $table->integer('user_id');
        });
        //Run the migration's door Terminal op te starten.
        //php artisan migrate om het in je phpmyadmin te krijgen.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Wil je de kolom niet meer doe dit;
        Schema::table('posts', function($table){
            //Delete de kolom.
            $table->dropColumn('user_id');
        });
        //Drop the migration's door Terminal op te starten.
        //php artisan migrate rollback zorgt ervoor dat de kolom uit phpmyadmin gehaald word.
    }
}
