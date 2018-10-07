@extends('layouts.app')

<!-- Wat je te zien krijgt wanneer je op een Post klikt -->

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    
    <h1>{{$post->title}}</h1>

    <!-- De afbeelding die bij de post hoort (als er een afbeelding is)-->
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    
    <br>
    <br>
    <br>

    <!-- Body -->
    <div>
        <!-- Als je het tussen haakjes zet dan zie je het in HTML-Code. -->
        {!!$post->body!!}
    </div>

    <hr><!--Linebreak -->
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>

    <!-- Als de user geen gast is dan kan de user de edit & delete knoppen niet zien -->
    @if(!Auth::guest())
        <!-- 
        |
        |Alleen de eigenaar van de gemaakte post kan deleten of editen;
        |Als de user_id gelijk is aan de post_user_id dan...
        |
        -->
        @if(Auth::user()->id == $post->user_id)                                                  
            
            <!-- Post-Editen knop-->
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>


            <!-- 
            |
            | Post deleten-Knop:
            | Wanneer je op de "Delete-knop" drukt word je doorgestuurd naar
            | de "destroy"functie die in de PostController staat
            |
            -->
            {!!Form::open(['action'=>['PostsController@destroy',$post->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
            {!!Form::close()!!}
            
        @endif
    @endif
@endsection