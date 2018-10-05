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
        $posts = Post::orderBy('created_at','desc')->paginate(10);

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
        //wanneer je /posts/create in je url typt kom je hier.
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* we stoppen de request variabele die is gestuurd met de "submit
        die daarna de functie parameters staat door.
        
        In de array schrijven we de regels waar de form zich aan moet houden.*/
        $this ->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);

        // Create Post (dit kunnen we doen omdat we App\Post hebben gebruikt boven aan de pagina)
        $post = new Post;                                           //Nieuwe post is aangemaakt
        $post -> title = $request->input('title');                  //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                    //Schrijf in de nieuwe post de gegeven body
        $post -> save();                                            //Save de gegevens van de nieuwe post in de database

        return redirect('/posts')->with('success', 'Post Created');//doorgestuurd naar /posts met de succes-message
        
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
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
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
            'body' => 'required'
        ]);

        // Create Post 
        $post = Post::find($id);                                        //Vind de post
        $post -> title = $request->input('title');                  //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                    //Schrijf in de nieuwe post de gegeven body
        $post -> save();                                            //Save de gegevens van de nieuwe post in de database

        return redirect('/posts')->with('success', 'Post Updated');//doorgestuurd naar /posts met de succes-message
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find the post doorgebruik van de post-id
        $post = Post::find($id);
        $post->delete();

        //Terug sturen naar posts-url
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
