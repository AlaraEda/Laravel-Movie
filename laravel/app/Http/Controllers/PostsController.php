<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //Zodat Post.php gebruikt word
use DB; //SQL word gebruikt inplaats van Eloquent
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();                                                         //$post bevat alle database gegevens van post tabel
        
        //Posts worden geordend bij de titel desc is van hoog naar laag.
            //$posts = Post::orderBy('title','desc')->get();                           //esc is van laag naar hoog

        //Laat maar 1 post gegeven zien
            //$posts = Post::orderBy('title','desc')->take(2)->get(); 
        
        //SQL
            //$posts = DB::select('SELECT * FROM posts');

        //Maar 10 post per pagina
        $posts = Post::orderBy('title','desc')->paginate(10);

        //Post variabele word meegegeven aan de view (en zichtbaar gemaakt)
        return view('posts/index')->with('posts', $posts);
        
        //index.blade.php (de index van posts) word weergeven
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Post is ons model. En hij vind de post doormiddel van het id.
        //Dus wanneer je/posts/1 schrijft bij je url krijg je alle posts gegevens die gelinkt staan aan id=1
        //return Post::find($id)
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
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
        //
    }
}
