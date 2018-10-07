<?php
//Controller voor als je bent ingelogd & je beschikt over een dashboard.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;                                                    //Maak gebruik van User.php model zodat je index()-functie kan gebruiken.

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('auth');                               //Blokkeer dashboard-data wanneer User niet ingelogt.
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;                          //Hier krijg je de User_Id van de persoon die is ingelogt.
        $user = User::find($user_id);                           //Vind de UserModel doormiddel van de User_id
        return view('dashboard')->with('posts', $user->posts);  //Geef deze informatie door naar de Dashboard met de posts van die ene user.
    }
}
