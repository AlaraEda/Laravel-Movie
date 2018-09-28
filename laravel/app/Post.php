<?php
//This is our model
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name (standaard is het gwn post)
    protected $table = 'posts';

    //Primary Key (standaard is het gwn id maar je kunt het hie
    //verandere naar item_id ofzo )
    public $primaryKey = 'id';

    //Timestamps (het is standaard true, maar als we timestamps niet wouden 
    //konden we kiezen voor false)
    public $timestamps = true;
}
