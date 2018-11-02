<?php

/*Controller is gecreerd met de naam "pagesController
wat een extention is van de orginele Controller.php */
namespace App\Http\Controllers;
use Illuminate\Http\Request;                                            //Request naar libary is aangebracht

class PagesController extends Controller                                //Elke controller die je maakt moet Controller extenden anders kan het niks.
{
    //Home-Page
    public function index(){                                            //Index-pagina
        $title = 'Welcome to MovieList!';
        return view('pages/index', compact('title'));                   //Verwerkt title in index-page door "compact"
    }

    //List-Page
    public function list(){
        $title = 'List-Page';
        return view('pages/list') -> with('title',$title);
    }
}
