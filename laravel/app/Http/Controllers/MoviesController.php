<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Movie;                              //Zodat Movie.php gebruikt wordt
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

    //Eerste wat je ziet wanneer je url: /list typt
    public function index()
    {
        $movies = Movie::orderBy('created_at','desc')->paginate(10);           //Maar 10 Posts per pagina.
        
        //Pas dit aan
        return view('pages/list')->with('movies', $movies);                    //Movies variabele word meegegeven aan de view.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Movies.create not found.
        return view('movies/create'); 
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
        $this ->validate($request,[                                                                     //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required'
        ]);

        //Create-Post
        $movie = new Movie;                                                     //New Movie; kunnen we doen omdat we App\Movie(movie.php model) hebben staan boven aan de pagina)
        //Status moet een default value hebben.
        $movie -> status = 'true';                                              //Status is qua default altijd "true"
        $movie -> title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
        $movie -> genre = $request->input('genre');                             //Schrijf in de nieuwe post de gegeven genre
        $movie -> score = $request->input('score');                             //Schrijf in de nieuwe post de gegeven score
        $movie -> comments = $request->input('comments');                       //Schrijf in de nieuwe post de gegeven comments

        $movie -> user_id = auth()->user()->id;                                 //We zetten geen 'request' want dit komt niet van de form.
                                                                                //Sla het nummer(id) van de momenteel ingelogde user op in User_id

        $movie -> save();                                                       //Save de gegevens van de nieuwe movie in database

        return redirect('/list')->with('success', 'Movie Added');               //Word doorgestuurd naar /list-pagina met de succes-message
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
