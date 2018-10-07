<?php

/*Controller is gecreerd met de naam "pagesController
wat een extention is van de orginele Controller.php */

namespace App\Http\Controllers;

use Illuminate\Http\Request;                                            //Request naar libary is aangebracht

class PagesController extends Controller                                //Elke controller die je maakt moet Controller extenden anders kan het niks.
{
    //Home-Page
    public function index(){                                            //public houd in dat je het buiten de class kan gebruiken
        $title = 'Welcome to MovieList!';
        return view('pages/index', compact('title'));                   //Verwerkt title in index-page door "compact"
    }

    //About-Page
    public function about(){
        $title = 'About Us';
        return view('pages/about') -> with('title',$title);
    }
    
    //Service Page
    public function services(){

        //Array of information
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming','SEO']
        );

        //Word doorgestuurd naar pages/services en neem mee de array-informatie van $data
        return view('pages/services') -> with($data);
    }
}
