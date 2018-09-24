<?php

namespace App\Http\Controllers;

//Request libary is aangebracht
use Illuminate\Http\Request;

/*Controller is gecreerd met de naam "pagesController
wat een extention is van de orginele Controller 

Elke controller die je maakt moet Controller extenden anders kan het niks.*/
class PagesController extends Controller
{
    //public houd in dat je het buiten de class kan gebruiken
    public function index(){
        //Het kijkt nu naar de view in pages/index
        return view('pages/index');
        //return 'INDEX';
    }
}
