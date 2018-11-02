<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Movie;                              //Zodat Movie.php gebruikt wordt
use App\User;                              //Zodat Movie.php gebruikt wordt
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
                                                                            //Blokkeer dashboard-data wanneer User niet ingelogt. 
        $this->middleware('auth',['except'=>['index','show']]);             //behalve de index-view (de lijst van blogposts) & de show-view(het laten zien van indivduele posts)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Eerste wat je ziet wanneer je url: /overzicht typt
    public function overzicht(Request $request){
        $search = $request->get('filter');

        if ($search === "ALLES"){
            $movies = Movie::orderBy('title')->where('status','true')->get();
        }else{
            $movies = DB::table('movies')
                ->where('title', 'like', $search.'%')
                ->where('status', 'true')
                ->get();
        }

        return view ("pages/overzicht")->with('movies', $movies);
    }

    //Watchlist
    public function watchlist(){
        $user_id = auth()->user()->id;                                      //Hier krijg je de User_Id van de persoon die is ingelogt.
        //$user = User::find($user_id);                                       //Vind de UserModel doormiddel van de User_id
        $movies = Movie::orderBy('title')->where('status', 'false')->where('user_id', $user_id)->get();
        //dd($user->movies);
        return view('pages/watchlist')->with('names', $movies);       //Geef deze informatie door naar de Dashboard met de movies van die ene user.
                                                                            //De ID van de user is nu verbonden met de watchlist-tabel
    }

    //Sharing the Watchlist
    public function shared(){
        $watchlist = Movie::orderBy('created_at','desc')
                            ->where('status', 'false')
                            ->paginate(10);                                 //Maar 10 Posts per pagina.
        
        return view('pages/shared')->with('watchlist', $watchlist);                   //Post-variabele word meegegeven aan de view.
    }

    //Tabel
    public function list()
    {
        $movies = Movie::orderBy('created_at','desc')->paginate(10);           //Maar 10 Posts per pagina.
        
        //Pas dit aan
        return view('pages/list')->with('movies', $movies);                    //Movies variabele word meegegeven aan de. 
                                                                               //En deze variabele word ook "movies" genoemd in je view template. 
                                                                               //Waardoor je het in je template kan gebruiken.
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
        is gestuurd doordat iemand op de "submit"-button
        door in de functie doormiddel van de parameters.*/
        
        //Validatie -->Zijn alle velden ingevuld?
        $this ->validate($request,[                                          //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required'     
        ]);

        //Create-Post
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

        
        $movie->user_id = auth()->user()->id;                                 //We zetten geen 'request' want dit komt niet van de form.
                                                                              //Sla het nummer(id) van de momenteel ingelogde user op in User_id

        $movie->save();                                                       //Save de gegevens van de nieuwe movie in database

        return redirect('/list')->with('success', 'Movie Added');             //Word doorgestuurd naar /list-pagina met de succes-message
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
        $movie = Movie::find($id);                                               //Vind Post doormiddel van ID
        
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

        //Check for correct user
        if(auth()->user()->id !=$Movie->user_id){                               //Als user_id niet hetzelfde is als movie_id...
            return redirect('/list')->with('error', 'Unauthorized Page');       //Redirect naar /list met error
        }
        return view('movies/edit')->with('movies', $Movie);                      //Word doorgestuurd naar de Edit url van movie met de oude data
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //Dit doet basically hetzelfde als de store-functie
    {
        //Validatie
        $this ->validate($request,[
            'title' => 'required'
        ]);

        // Create/Update Movie 
        $movie = Movie::find($id);                                          //Vind de Movie op id doormiddel van het zoeken in de Movie Model
        $movie -> title = $request->input('title');                         //Schrijf in de nieuwe post de gegeven titel
        $movie -> genre = $request->input('genre');                         //Schrijf in de nieuwe post de gegeven genre
        $movie -> score = $request->input('score');                         //Schrijf in de nieuwe post de gegeven score
        $movie -> comments = $request->input('comments');                   //Schrijf in de nieuwe post de gegeven comments
        
        $movie -> save();                                                   //Save de gegevens van de nieuwe post in de database

        return redirect('/list')->with('success', 'Movie Updated');         //doorgestuurd naar /list met de succes-message

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);                                         //Find the post met post-id
        
        if(auth()->user()->id !=$movie->user_id){                          ///Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
            return redirect('/list')->with('error', 'Unauthorized Page');  //Redirect naar /posts met error message.
        }

        $movie->delete();
        return redirect('/list')->with('success', 'Movie Removed');    
    }
}
