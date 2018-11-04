<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\User;                               //Zodat Movie.php gebruikt wordt
use App\Movie;
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
        $this->middleware('auth');                                          //Blokkeer dashboard-data wanneer User niet ingelogt.
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
     //Watchlist
    public function watchlist(){
        $user_id = auth()->user()->id;                                       //Hier krijg je de User_Id van de persoon die is ingelogt.
        $movies = Movie::orderBy('title')
                ->where('status', 'false')
                ->where('user_id', $user_id)
                ->get();                                                     //De ID van de user is nu verbonden met de watchlist-tabel

        return view('pages/watchlist')->with('names', $movies);                                                                             
    }

    //Sharing the Watchlist-page
    public function shared(){

        $user_id = auth()->user()->id;                                       //De User_Id van de ingelogte persoon.

        $watchlist1 = Movie::orderBy('created_at','desc')                    //Vind de posts (die in de watchlist staan) die horen bij de ingelogde user
                            ->where('status', 'false')
                            ->where('user_id', $user_id)
                            ->get();                                  
        
        //Share1 houd in dat de user mag sharen
        $watchlist2 = Movie::orderBy('created_at','desc')                   //Vind de posts (die in de wachtlist staan) van alle users waar kolom-share 1 is.
                    ->where('status', 'false')
                    ->where('share', 1)
                    ->get();

        if(count($watchlist1)>4){                                           //Als Ingelogde user meer dan 4 posts heeft.
            
            $la = Movie::where('user_id', $user_id)->get();                 //Selecteer alle posts van de ingelogde user

            foreach($la as $lol){
                if($lol->share == 0){                                       //Als post van de ingelogde user 0 is
                    $lol->share = 1;                                        //Verander post naar 1
                    
                    $lol->save();
                }

            }
            return view('pages/shared')->with('watchlist', $watchlist2);    //Laat de meer dan 5 posts zien.
        }
        else{                                                               //Als ingelogte user niet meer dan 4 posts heeft.

            $la = Movie::where('user_id', $user_id)->get();                 //Selecteer alle posts van de ingelogde user

            foreach($la as $lol){
                if($lol->share == 1){                                       //Als de posts geshared mocht worden
                    $lol->share = 0;                                        //Share posts niet
                    
                    $lol->save();
                }

            }
            return view('pages/shared')->with('watchlist', $watchlist1);    //Laat alleen je eigen posts zien, niet die van anderen.
        }
    }

    //Flip Functie-Watchlist
    public function flip($id){
        $flip = Movie::find($id);
        
        if ($flip->status == 'false'){
            $flip->status = 'true';
            $flip->save();
        }
        else{
            $flip->status = 'false';
            $flip->save();
        }

        //Herhaling van wat er al in watchlist() functie staat;
        $user_id = auth()->user()->id;                                      //Hier krijg je de User_Id van de persoon die is ingelogt.
        $movies = Movie::orderBy('title')
                ->where('status', 'false')
                ->where('user_id', $user_id)
                ->get();

        return view('pages/watchlist')->with('names', $movies);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $watch = new Movie;                                                   //New Movie; kunnen we doen omdat we App\Movie(movie.php model) hebben staan boven aan de pagina)
        $watch->status = 'false';                                             //Status is qua default altijd "false"
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

        return redirect('/watchlist')->with('success', 'Movie Added');        //Word doorgestuurd naar /list-pagina met de succes-message
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Dus wanneer je/movie/1 schrijft bij je url krijg 
        je alle posts gegevens die gelinkt staan aan id=1 */
        $watch = Movie::find($id);                                               //Vind Post doormiddel van ID
        
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
        $watch = Movie::find($id);

        //Check for correct user
        if(auth()->user()->id !=$watch->user_id){                               //Als user_id niet hetzelfde is als movie_id...
            return redirect('/list')->with('error', 'Unauthorized Page');       //Redirect naar /list met error
        }
        return view('watch/edit')->with('watch', $watch);                       //Word doorgestuurd naar de Edit url van movie met de oude data
    
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
        $watch = Movie::find($id);                                              //Vind de Movie op id doormiddel van het zoeken in de Movie Model
        $watch -> title = $request->input('title');                             //Schrijf in de nieuwe movie de gegeven titel
        $watch -> genre = $request->input('genre');                             //Schrijf in de nieuwe movie de gegeven genre
        $watch -> comments = $request->input('comments');                       //Schrijf in de nieuwe movie de gegeven comments
        
        $watch -> save();                                                       //Save de gegevens van de nieuwe movie in de database

        return redirect('/watchlist')->with('success', 'Movie Updated');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {    
        $watch = Movie::find($id);                                              //Find the post met post-id
        
        if(auth()->user()->id !=$watch->user_id){                               //Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
            return redirect('/watchlist')->with('error', 'Unauthorized Page');  //Redirect naar /posts met error message.
        }

        $watch->delete();

        return redirect('/watchlist')->with('success', 'Movie Removed');        
    }
}
