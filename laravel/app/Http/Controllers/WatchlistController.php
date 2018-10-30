<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\User;                              //Zodat Movie.php gebruikt wordt
use App\Watchlist;
use DB;                                     //SQL word gebruikt inplaats van Eloquent

class WatchlistController extends Controller
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
        $user_id = auth()->user()->id;                                      //Hier krijg je de User_Id van de persoon die is ingelogt.
        $user = User::find($user_id);                                       //Vind de UserModel doormiddel van de User_id
        return view('pages/watchlist')->with('names', $user->watchlist);    //Geef deze informatie door naar de Dashboard met de movies van die ene user.
                                                                            //De ID van de user is nu verbonden met de watchlist-tabel
    }

    public function shared(){
        $watchlist = Watchlist::orderBy('created_at','desc')->paginate(10);           //Maar 10 Posts per pagina.
        
        return view('pages/shared')->with('watchlist', $watchlist);                   //Post-variabele word meegegeven aan de view.
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* we stoppen de request die naar de MoviesController 
        is gestuurd doordat iemand op de "submit"-button
        door in de functie doormiddel van de parameters.*/
        
        //Validatie -->Zijn alle velden ingevuld?
        $this ->validate($request,[                                          //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required',
            'genre'=> 'required'    
        ]);

        //Create-Post
        $watch = new Watchlist;                                                   //New Movie; kunnen we doen omdat we App\Movie(movie.php model) hebben staan boven aan de pagina)
        $watch->status = 'true';                                              //Status is qua default altijd "true"
        $watch->title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
 
        //Genre
        if ($request->input('genre') == null){                               //Als er niks ingevuld word bij "genre"
            $watch->genre = '-';                                             //schrijf als default value -
        }
        else{                                                                //Anders;
            $watch->genre = $request->input('genre');                        //Schrijf in de nieuwe post de gegeven genre
        }

        //Comments
        if ($request->input('comments') == null){                              
            $watch->comments = '-';                                            
        }
        else{                                                               
            $watch->comments = $request->input('comments');                       
        }

        
        $watch->user_id = auth()->user()->id;                                 //We zetten geen 'request' want dit komt niet van de form.
                                                                              //Sla het nummer(id) van de momenteel ingelogde user op in User_id

        $watch->save();                                                       //Save de gegevens van de nieuwe movie in database

        return redirect('/watchlist')->with('success', 'Movie Added');             //Word doorgestuurd naar /list-pagina met de succes-message
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Dus wanneer je/posts/1 schrijft bij je url krijg 
        je alle posts gegevens die gelinkt staan aan id=1 */
        $watch = Watchlist::find($id);                                               //Vind Post doormiddel van ID
        
        return view('watch/show')->with('watch', $watch);  
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $watch = Watchlist::find($id);

        //Check for correct user
        if(auth()->user()->id !=$watch->user_id){                               //Als user_id niet hetzelfde is als movie_id...
            return redirect('/list')->with('error', 'Unauthorized Page');       //Redirect naar /list met error
        }
        return view('watch/edit')->with('watch', $watch);                      //Word doorgestuurd naar de Edit url van movie met de oude data
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validatie
        $this ->validate($request,[
            'title' => 'required',
            'genre' => 'required'
        ]);

        // Create/Update Movie 
        $watch = Watchlist::find($id);                                          //Vind de Movie op id doormiddel van het zoeken in de Movie Model
        $watch -> title = $request->input('title');                         //Schrijf in de nieuwe post de gegeven titel
        $watch -> genre = $request->input('genre');                         //Schrijf in de nieuwe post de gegeven genre
        $watch -> comments = $request->input('comments');                   //Schrijf in de nieuwe post de gegeven comments
        
        $watch -> save();                                                   //Save de gegevens van de nieuwe post in de database

        return redirect('/watchlist')->with('success', 'Movie Updated');         //doorgestuurd naar /list met de succes-message

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            
        $watch = Watchlist::find($id);                                            //Find the post met post-id
        
        if(auth()->user()->id !=$watch->user_id){                            ///Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
            return redirect('/watchlist')->with('error', 'Unauthorized Page');  //Redirect naar /posts met error message.
        }

        $watch->delete();
        return redirect('/watchlist')->with('success', 'Movie Removed');        
    
    }
}
