<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';                        //Table Name (standaard is het gwn movie)
    
    public function user(){                             //Creeer een relatie tussen movie & user tabel
        return $this ->belongsTo('App\User');           //Één movienaam behoort toe aan een user.
    }
}
