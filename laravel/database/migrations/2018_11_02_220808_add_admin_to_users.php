<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){        //Kolom aanmaken met de naam "users"
            $table->boolean('admin')->default(0);                   //Bevat kolom met de naam user_id en bestaat uit integers.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropColumn('admin');              //Delete de kolom.
        });

                                                        /*Drop the migration's door Terminal op te starten.
                                                        php artisan migrate rollback zorgt ervoor dat de kolom 
                                                        uit phpmyadmin gehaald word. */
    }
}
