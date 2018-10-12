<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function user(){ //Creeer een relatie tussen movie & user tabel
        return $this ->belongsTo('App\User'); //Één movienaam behoort toe aan een user.
    }
}
