<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabel "Posts" aanpassen
        Schema::table('posts', function($table){
            $table->string('cover_image');                                      //De kolom heet cover_image & zal gevuld worden met integers.
        });
        /*Run the migration's door Terminal op te starten.
        php artisan migrate om het in je phpmyadmin te krijgen. */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table){
            $table->dropColumn('cover_image');                                   //De kolom gaat heten cover_image en zal gevuld worden met integers.
        });
    }
}
