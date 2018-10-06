<?php
//Controller voor als je bent ingelogd.
namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Breng the User model in bij de dashboard control zodat er gebruikt van kan worden gemaakt bij index()
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
