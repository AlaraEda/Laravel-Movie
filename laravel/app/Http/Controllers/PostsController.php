<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Post;                               //Zodat Post.php gebruikt word
use DB;                                     //SQL word gebruikt inplaats van Eloquent

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Alles word geblokkeerd als de User niet geauthenticeerd is. 
        $this->middleware('auth',['except'=>['index','show']]);                        //behalve de index-view (de lijst van blogposts) & de show-view(het laten zien van indivduele posts)
    }

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
            'body' => 'required',
            'cover_image'=> 'image |nullable|max:1999'              //File has to be an 'image', nullable houd in dat je niet perse een image hoeft te uploaden, max:1999 is de maximale grootte van de image
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){                                                           //Als de user een file upload word de naam van de image cover_image...
            
            //Get filename with the extension                                                           //Vraag om file met de naam 'cover_image'
            $filenameWithExt = $request ->file('cover_image')->getClientOriginalName();                

            //Get just filename                                                                         //In de variabele filename worden de gegevens van $filenameWithExt doorgegeven.
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);                                  //PATHINFO_FILENAME neemt de naam van de image.
            
            //Get just ext                                                                              
            $extension = $request->file('cover_image')->getClientOriginalExtension();                    
            
            //Filename to store                                                                         //Vraagt om de orginele file naam en voegt daar een tijdstamp aan toe. 
            $fileNameToStore = $filename.'_'.time().'.'.$extension;                                     // Dus als iemand anders dezelfde filenaam heeft zal de ene file de andere niet overrijden aangezien ze aparte timestamps hebben.
            
            //Upload Image                                                                              //Vraag om de file cover_image, creeer de folder public/cover_image.
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);    //Wanneer je zegt storeAs dan gaat de file naar de volder storage --> app -->public en daar creeert hij dan 'cover_image" in de public folder.  

        }else{                                                                                          //Als de user NIET een file wou uploaden.
            $fileNameToStore = 'noimage.jpg';                                                           //Dan word default image 'noimage.jpg' gebruikt in de posts.
        }


        // Create Post (dit kunnen we doen omdat we App\Post hebben gebruikt boven aan de pagina)
        $post = new Post;                                           //Nieuwe post is aangemaakt
        $post -> title = $request->input('title');                  //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                    //Schrijf in de nieuwe post de gegeven body
        $post -> user_id = auth()->user()->id;                       //We zetten geen 'request' want dit komt niet van de form.
        //auth()->user()->id; zal de momenteel ingelogde user nemen en dat nummer in de user_id stoppen en opslaan.
        $post->cover_image = $fileNameToStore;                       //Dus in de tabel word het opgeslagen als of noimage.jpg of als de echte naam van de file
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

        //Check for correct user
        if(auth()->user()->id !=$post->user_id){                                //Als user id niet hetzelfde is als post id
            return redirect('/posts')->with('error', 'Unauthorized Page');     //Redirect naar post
        }
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

        //Handle File Upload
        if($request->hasFile('cover_image')){                                                           //Als de user een file upload word de naam van de image cover_image...
            
            //Get filename with the extension                                                           //Vraag om file met de naam 'cover_image'
            $filenameWithExt = $request ->file('cover_image')->getClientOriginalName();                

            //Get just filename                                                                         //In de variabele filename worden de gegevens van $filenameWithExt doorgegeven.
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);                                  //PATHINFO_FILENAME neemt de naam van de image.
            
            //Get just ext                                                                              
            $extension = $request->file('cover_image')->getClientOriginalExtension();                    
            
            //Filename to store                                                                         //Vraagt om de orginele file naam en voegt daar een tijdstamp aan toe. 
            $fileNameToStore = $filename.'_'.time().'.'.$extension;                                     // Dus als iemand anders dezelfde filenaam heeft zal de ene file de andere niet overrijden aangezien ze aparte timestamps hebben.
            
            //Upload Image                                                                              //Vraag om de file cover_image, creeer de folder public/cover_image.
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);    //Wanneer je zegt storeAs dan gaat de file naar de volder storage --> app -->public en daar creeert hij dan 'cover_image" in de public folder.  

        }


        // Create Post 
        $post = Post::find($id);                                        //Vind de post
        $post -> title = $request->input('title');                      //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                        //Schrijf in de nieuwe post de gegeven body
        if($request->hasFile('cover_image')){                           //Als er een file ge-update is...
            $post->cover_image= $fileNameToStore;                       //Vervang het dan met FilenameToStore (als dat niet zo is blijft het dezelfde file)
        }
        $post -> save();                                                //Save de gegevens van de nieuwe post in de database

        return redirect('/posts')->with('success', 'Post Updated');     //doorgestuurd naar /posts met de succes-message
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
        
        //Check for correct user(zodat niet de verkeerde user je post kan deleten)
        if(auth()->user()->id !=$post->user_id){                                //Als user id niet hetzelfde is als post id
            return redirect('/posts')->with('error', 'Unauthorized Page');     //Redirect naar post
        }
        
        if($post->cover_image!= 'noimage.jpg'){                             //Als de cover_image niet gelijk is aan "noimage.jpg" (dus als je bij het editen niet dezelfde image upload maar een andere)
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);           //door $post->cover te typen haal je de naam van de foto op
        }

        $post->delete();

        //Terug sturen naar posts-url
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
