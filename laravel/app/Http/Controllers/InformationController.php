<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Movie;                              //Zodat Movie.php gebruikt wordt
use App\User;                               //Zodat Movie.php gebruikt wordt
use DB;                                     //SQL word gebruikt inplaats van Eloquent

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Tabel
    public function index()
    {
        $users = User::orderBy('name','desc')->paginate(10);           //Maar 10 movies per pagina.
        
        return view('pages/information')->with('users', $users);
    }

    public function indexSearch(Request $request){
        $search = $request->input('search');

        if($search != ''){

            $users = User::orderBy('name')
            ->where('name', 'like', $search.'%')
            ->orWhere('email', 'like', $search.'%')
            ->get();

        }else{
            $users = [];
        }
        return view('pages/information')->with('users', $users);
    }
    //Search-Bar van Tabel
    public function Search(Request $request){
        $search = $request->input('search');

        if($search != ''){

            $movies = Movie::orderBy('title')
            ->where('title', 'like', $search.'%')
            ->orWhere('genre', 'like', $search.'%')
            ->orWhere('score', 'like', $search.'%')
            ->orWhere('comments', 'like', $search.'%')
            
            // ->join('users', 'users.id', "=", "movies.user_id")
            // ->orWhere('users.name', 'like', $search.'%')
            ->get();

        }else{
            $movies = [];
        }

        return view('information/show')->with('movies', $movies);
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
        je alle posts gegevens die gelinkt staan aan de persoon met id=1 */
        //$movies = Movie::find($id);                                               //Vind Post doormiddel van ID
        
        $movies = Movie::orderBy('title')
        
        ->where('user_id', '=', $id)
        
        ->get();

        return view('information/show')->with('movies', $movies);  
        

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('information/create'); 
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
        is gestuurd -doordat iemand op de "submit"-button 
        heeft geklikt- door in de functie doormiddel van de parameters.*/
        
        //Validatie -->Zijn alle velden ingevuld?
        $this ->validate($request,[                                           //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required'     
        ]);

        //Create New Movie
        $movie = new Movie;                                                   //New Movie; kunnen we doen omdat we App\Movie(movie.php model) hebben staan boven aan de pagina)
        $movie->title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
        
        //Status
        if($request->input('status') == null){
            $movie->status = "-";
        }else{
            $movie->status = $request->input('status');
        }

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

        return redirect('/information')->with('success', 'Movie Added');
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

        return view('information/edit')->with('movies', $Movie);                     //Word doorgestuurd naar de Edit url van movie met de oude data
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
            'title' => 'required'
        ]);

        // Create/Update Movie 
        $movie = Movie::find($id);                                              //Vind de Movie op id doormiddel van het zoeken in de Movie Model
        $movie -> status = $request->input('status');
        $movie -> title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
        $movie -> genre = $request->input('genre');                             //Schrijf in de nieuwe post de gegeven genre
        $movie -> score = $request->input('score');                             //Schrijf in de nieuwe post de gegeven score
        $movie -> comments = $request->input('comments');                       //Schrijf in de nieuwe post de gegeven comments
        
        $movie -> save();                                                       //Save de gegevens van de nieuwe post in de database

        return redirect('/information')->with('success', 'Movie Updated');        //Doorgestuurd naar /Overzicht met de succes-message

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
        
        // if(auth()->user()->id !=$movie->user_id){                               //Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
        //     return redirect('/')->with('error', 'Unauthorized Page');           //Redirect naar /home met error message.
        // }

        $movie->delete();
        return redirect('/information')->with('success', 'Movie Removed');    
    
    }
}
