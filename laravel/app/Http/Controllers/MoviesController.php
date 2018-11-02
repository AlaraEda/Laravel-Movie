<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Movie;                              //Zodat Movie.php gebruikt wordt
use App\User;                               //Zodat Movie.php gebruikt wordt
use DB;                                     //SQL word gebruikt inplaats van Eloquent


class MoviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {                                                       
        $this->middleware('auth');                                              //Blokkeer alle pages wanneer User niet is ingelogt.
        //$this->middleware('auth',['except'=>['index','show']]);               //Blokkeer alles BEHALVE index & show-functies als User niet is gelogd.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //url: /overzicht
    public function overzicht(Request $request){                                //Krijg Filter-Request binnen
        $user_id = auth()->user()->id;                                          //Hier krijg je de User_Id van de persoon die is ingelogt.
        
        $search = $request->get('filter');                                      //Stop de value v/d request in $search                              

        if ($search === "ALLES"){
            $movies = Movie::orderBy('title')
                ->where('status', 'true')
                ->where('user_id', $user_id)
                ->get();
        }else{                                                                  //Als je op een letter-filter hebt geklikt;                                                      
            $movies = Movie::orderBy('title')
                ->where('title', 'like', $search.'%')                           //Zoek naar een titel die begint met de eerst gegeven letter.
                ->where('status', 'true')
                ->where('user_id', $user_id)
                ->get();
            
            /*
            $movies = DB::table('movies')
                ->where('title', 'like', $search.'%')                           
                ->where('status', 'true')
                ->where('user_id', $user_id)
                ->get();
            */
        }
        return view ("pages/overzicht")->with('movies', $movies);
    }

    //Search-Bar van List
    public function search(Request $request){
        //dd($request);
        $search = $request->input('search');

        if($search != ''){
            $movies = Movie::orderBy('title')
            ->where('title', 'like', $search.'%')
            ->orWhere('genre', 'like', $search.'%')
            ->orWhere('score', 'like', $search.'%')
            ->get();
        }else{
            $movies = [];
        }

        return view('pages/list')->with('movies', $movies);
    }

    //Flip Functie-Overzicht
    public function flip($id){
        $flip = Movie::find($id);                                               //Haal de gegevens op die gekoppeld staan aan de movie-id
        
        if ($flip->status == 'true'){
            $flip->status = 'false';
            $flip->save();
        }
        else{
            $flip->status = 'true';
            $flip->save();
        }

        //Herhaling van wat er al in watchlist() functie staat;
        $user_id = auth()->user()->id;                                          //Hier krijg je de User_Id van de persoon die is ingelogt.
        $movies = Movie::orderBy('title')
                ->where('status', 'false')
                ->where('user_id', $user_id)
                ->get();
        
        return view('pages/overzicht')->with('names', $movies);
    }

    //Tabel
    public function list()
    {
        $movies = Movie::orderBy('created_at','desc')->paginate(10);           //Maar 10 movies per pagina.
        
        //Pas dit aan
        return view('pages/list')->with('movies', $movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('movies/create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Opslaan in database

    public function store(Request $request)
    {
        /* we stoppen de request die naar de MoviesController 
        is gestuurd -doordat iemand op de "submit"-button 
        heeft geklikt- door in de functie doormiddel van de parameters.*/
        
        //Validatie -->Zijn alle velden ingevuld?
        $this ->validate($request,[                                           //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required'     
        ]);

        //Create New Movie
        $movie = new Movie;                                                   //New Movie; kunnen we doen omdat we App\Movie(movie.php model) hebben staan boven aan de pagina)
        $movie->status = 'true';                                              //Status is qua default altijd "true"
        $movie->title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel

        //Genre
        if ($request->input('genre') == null){                               //Als er niks ingevuld word bij "genre"
            $movie->genre = '-';                                             //schrijf als default value -
        }
        else{                                                                //Anders;
            $movie->genre = $request->input('genre');                        //Schrijf in de nieuwe post de gegeven genre
        }

        //Score
        if ($request->input('score') == null){                              
            $movie->score = '-';                                            
        }
        else{                                                               
            $movie->score = $request->input('score');                       
        }

        //Comments
        if ($request->input('comments') == null){                              
            $movie->comments = '-';                                            
        }
        else{                                                               
            $movie->comments = $request->input('comments');                       
        }

        $movie->user_id = auth()->user()->id;                                //Sla het nummer(id) van de momenteel ingelogde user op in User_id     
        $movie->save();                                                      //Save de gegevens van de nieuwe movie in database

        return redirect('/overzicht')->with('success', 'Movie Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Dus wanneer je /movie/1 schrijft bij je url krijg 
        je alle posts gegevens die gelinkt staan aan id=1 */
        $movie = Movie::find($id);                                              //Vind Movie doormiddel van ID
        
        return view('movies.show')->with('movies', $movie);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Movie = Movie::find($id);

        //Check for correct user (overbodig)
        if(auth()->user()->id !=$Movie->user_id){                               //Als user_id niet hetzelfde is als movie_id...
            return redirect('/list')->with('error', 'Unauthorized Page');       //Redirect naar /list met error
        }

        return view('movies/edit')->with('movies', $Movie);                     //Word doorgestuurd naar de Edit url van movie met de oude data
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)                               //Dit doet basically hetzelfde als de store-functie
    {
        //Validatie
        $this ->validate($request,[
            'title' => 'required'
        ]);

        // Create/Update Movie 
        $movie = Movie::find($id);                                              //Vind de Movie op id doormiddel van het zoeken in de Movie Model
        $movie -> title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
        $movie -> genre = $request->input('genre');                             //Schrijf in de nieuwe post de gegeven genre
        $movie -> score = $request->input('score');                             //Schrijf in de nieuwe post de gegeven score
        $movie -> comments = $request->input('comments');                       //Schrijf in de nieuwe post de gegeven comments
        
        $movie -> save();                                                       //Save de gegevens van de nieuwe post in de database

        return redirect('/overzicht')->with('success', 'Movie Updated');        //Doorgestuurd naar /Overzicht met de succes-message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $movie = Movie::find($id);                                              //Find the post met post-id
        
        if(auth()->user()->id !=$movie->user_id){                               //Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
            return redirect('/')->with('error', 'Unauthorized Page');           //Redirect naar /home met error message.
        }

        $movie->delete();
        return redirect('/overzicht')->with('success', 'Movie Removed');    
    }
}
