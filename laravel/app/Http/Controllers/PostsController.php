<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;     //Storage of Photo's library
use App\Post;                               //Zodat Post.php gebruikt wordt
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
                                                                            //Blokkeer dashboard-data wanneer User niet ingelogt. 
        $this->middleware('auth',['except'=>['index','show']]);             //behalve de index-view (de lijst van blogposts) & de show-view(het laten zien van indivduele posts)
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$posts = Post::all();                                              //$post bevat alle database gegevens van post-tabel.
        //$posts = Post::orderBy('title','desc')->get();                     //Posts worden geordend bij de titel desc is van hoog naar laag.
                                                                             //esc is van laag naar hoog.
        //$posts = Post::orderBy('title','desc')->take(2)->get();            //Laat maar 1 post gegeven zien.
        //$posts = DB::select('SELECT * FROM posts');                        //SQL.

        $posts = Post::orderBy('created_at','desc')->paginate(10);           //Maar 10 Posts per pagina.
        
        return view('posts/index')->with('posts', $posts);                   //Post-variabele word meegegeven aan de view.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');                                          //Wanneer je /posts/create in je URL typt kom je hier.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Data Invoeger
    public function store(Request $request)
    {
        /* we stoppen de request die naar de PostsController 
        is gestuurd doordat iemand op de "submit"-button
        door in de functie doormiddel van de parameters.*/
        
        //Validatie
        $this ->validate($request,[                                           //In de array staan de regels waar de form zich aan moet houden.
            'title' => 'required',
            'body' => 'required',
            'cover_image'=> 'image |nullable|max:1999'                        //File moet of een 'image' of niks of max:1999 groot zijn
        ]);

        //File Upload Handeling
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


        //Create-Post
        $post = new Post;                                                      //New Post; kunnen we doen omdat we App\Post(post.php model) hebben staan boven aan de pagina)
        $post -> title = $request->input('title');                             //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                               //Schrijf in de nieuwe post de gegeven body

        $post -> user_id = auth()->user()->id;                                 //We zetten geen 'request' want dit komt niet van de form.
                                                                               //Sla het nummer(id) van de momenteel ingelogde user op in User_id
        
        $post->cover_image = $fileNameToStore;                                 //In tabel word opgeslagen noimage.jpg of als de echte naam van de file
        $post -> save();                                                       //Save de gegevens van de nieuwe post in database

        return redirect('/posts')->with('success', 'Post Created');            //Stuur data door naar /posts met de succes-message
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
        $post = Post::find($id);                                               //Vind Post doormiddel van ID
        return view('posts.show')->with('post', $post);     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Post-Aanpassen
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !=$post->user_id){                               //Als user_id niet hetzelfde is als post_id...
            return redirect('/posts')->with('error', 'Unauthorized Page');     //Redirect naar /post met error
        }
        return view('posts.edit')->with('post', $post);                        //Anders ga naar posts/edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Update-Posts
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


        // Create/Update Post 
        $post = Post::find($id);                                            //Vind de post op id
        $post -> title = $request->input('title');                          //Schrijf in de nieuwe post de gegeven titel
        $post -> body = $request->input('body');                            //Schrijf in de nieuwe post de gegeven body
        if($request->hasFile('cover_image')){                               //Als er een file ge-update is...
            $post->cover_image= $fileNameToStore;                           //Vervang het dan met FilenameToStore (als dat niet zo is blijft het dezelfde file)
        }
        $post -> save();                                                    //Save de gegevens van de nieuwe post in de database

        return redirect('/posts')->with('success', 'Post Updated');         //doorgestuurd naar /posts met de succes-message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);                                            //Find the post met post-id
        
        if(auth()->user()->id !=$post->user_id){                            ///Als user_id niet hetzelfde is als post_id (anders kunnen andere mensen je post deleten)
            return redirect('/posts')->with('error', 'Unauthorized Page');  //Redirect naar /posts met error message.
        }
        
        if($post->cover_image!= 'noimage.jpg'){                             //Als de cover_image niet gelijk is aan "noimage.jpg" (dus als je bij het editen niet dezelfde image upload maar een andere)                                                   
            Storage::delete('public/cover_images/'.$post->cover_image);     //Delete Image uit geheugen
                                                                            //Door $post->cover te typen haal je de naam van de foto op
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');        
    }
}
