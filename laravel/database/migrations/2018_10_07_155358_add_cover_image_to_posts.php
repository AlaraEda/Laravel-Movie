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
        //Tabel dat aangepast gaat worden is "posts"
        Schema::table('posts', function($table){
            //De kolom gaat heten cover_image en zal gevuld worden met integers.
            $table->string('cover_image');
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
        Schema::table('posts', function($table){
            //De kolom gaat heten cover_image en zal gevuld worden met integers.
            $table->dropColumn('cover_image');
        });
    }
}
