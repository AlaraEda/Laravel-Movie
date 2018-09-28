<?php

namespace App\Http\Controllers;

//Request naar libary is aangebracht
use Illuminate\Http\Request;

/*Controller is gecreerd met de naam "pagesController
wat een extention is van de orginele Controller.php */

//Elke controller die je maakt moet Controller extenden anders kan het niks.
class PagesController extends Controller
{
    //public houd in dat je het buiten de class kan gebruiken
    public function index(){
        $title = 'Welcome to Laravel!';

        //Het kijkt nu naar de view in pages/index
        return view('pages/index', compact('title'));                           //Verwerkt title in index-page door "compact"
        
        //return 'INDEX';
    }

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
