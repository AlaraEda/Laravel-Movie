<?php
//This is Post.php model
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';                         //Table Name (standaard is het gwn post)

    public $primaryKey = 'id';                          //Primary Key (standaard is het gwn id maar je kunt het hier
                                                        //verandere naar item_id ofzo )

    public $timestamps = true;                          //Timestamps (het is standaard true, maar als we timestamps niet wouden 
                                                        //konden we kiezen voor false)

    public function user(){                             //Creeer een relatie tussen post & user tabel                                           
        return $this->belongsTo('App\User');            //Één post behoort toe aan één user.
    }
}
