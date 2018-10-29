<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchlists', function (Blueprint $table) {
            $table->increments('id');//Primary Key
            $table->string('status');
            $table->string('title');
            $table->string('genre')->nullable()->change();
            $table->string('score')->nullable()->change();
            $table->string('comments')->nullable()->change();
            $table->timestamps(); //Created at/Updated at
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
        Schema::dropIfExists('watchlists');
    }
}
