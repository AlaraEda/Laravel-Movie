@extends('layouts.app')

<!-- Wat je te zien krijgt wanneer je op een Post klikt -->

@section('content')
    <a href="/overzicht" class="btn btn-default">Go Back</a>
    
    <h1>{{$movies->title}}</h1>

    <br>

    <!-- genre -->
    <div><b>Movie Genre:</b>{!!$movies->genre!!}</div>
    <div><b>Movie Score: </b>{!!$movies->score!!}</div>
    <br>
    <div><b>Movie Comments: </b>
    <br>
    {!!$movies->comments!!}</div>

    <hr><!--Linebreak -->
    <small>Written on {{$movies->created_at}} by {{$movies->user->name}}</small>
    <hr>

    <!-- Als de user geen gast is dan kan de user de edit & delete knoppen niet zien -->
    @if(!Auth::guest())
        <!-- 
        |
        |Alleen de eigenaar van de gemaakte post kan deleten of editen;
        |Als de user_id gelijk is aan de post_user_id dan...
        |
        -->
        @if(Auth::user()->id == $movies->user_id)                                                  
            
        <div class="row">
            <div class="col-1">
                <!-- Post-Editen knop-->
                <a class="btn btn-primary" href="/overzicht/{{$movies->id}}/edit" role="button">Edit</a>
            </div>
            <!-- 
            |
            | Post deleten-Knop:
            | Wanneer je op de "Delete-knop" drukt word je doorgestuurd naar
            | de "destroy"functie die in de PostController staat
            |
            -->
            
            <div>
            {!!Form::open(['action'=>['MoviesController@destroy',$movies->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
            {!!Form::close()!!}
            </div>
        </div>
        @endif
    @endif
@endsection