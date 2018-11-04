<!-- Content van create-page voor movies-->
@extends('layouts.app')

@section('content')
    <br>
    <h1>Create Post</h1>
    <!-- 
    |-----------------------------------------------------------------
    |Controllerfunction van store word opgevraagt.
    |-----------------------------------------------------------------
    -->
    {!! Form::open(['action'=>'MoviesController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            <!-- De labelnaam is title. De echte tekst word Title-->
            <b>{{Form::label('title', 'Title:')}}</b>                                               

            <!--
            |---------------------------------------------------------------------------------------
            |'' is leeg omdat het een createform is. We willen geen value die erin staat 
            |dus word het een lege string daarna stoppen we attributen in de array (zoals de class 
            |form-control wat een bootstrap class is) zonder form-control word het vakje klein
            |----------------------------------------------------------------------------------------
            -->

            {{Form::text('title', '',['class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>

        <br>
        <div class="form-group">
            {{Form::label('genre', 'Action')}}                                               
            {{Form::checkbox('genre', 'Action',false)}}

            {{Form::label('genre', 'Romance')}}                                               
            {{Form::checkbox('genre', 'Romance',false)}}

            {{Form::label('genre', 'Drama')}}                                               
            {{Form::checkbox('genre', 'Drama',false)}}

            {{Form::label('genre', 'Thriller')}}                                               
            {{Form::checkbox('genre', 'Thriller',false)}}

            {{Form::label('genre', 'Western')}}                                               
            {{Form::checkbox('genre', 'Western',false)}}

            {{Form::label('genre', 'Science Fiction')}}                                               
            {{Form::checkbox('genre', 'Science Fiction',false)}}

            {{Form::label('genre', 'Animation')}}                                               
            {{Form::checkbox('genre', 'Animation',false)}}

            {{Form::label('genre', 'Pornographic')}}                                               
            {{Form::checkbox('genre', 'Pornographic',false)}}

            {{Form::label('genre', 'Horror')}}                                               
            {{Form::checkbox('genre', 'Horror',false)}}

            {{Form::label('genre', 'Adventure')}}                                               
            {{Form::checkbox('genre', 'Adventure',false)}}

            {{Form::label('genre', 'Documentary')}}                                               
            {{Form::checkbox('genre', 'Documentary',false)}}

            {{Form::label('genre', 'Fiction')}}                                               
            {{Form::checkbox('genre', 'Fiction',false)}}

            {{Form::label('genre', 'Crime')}}                                               
            {{Form::checkbox('genre', 'Crime',false)}}

            {{Form::label('genre', 'Romantic Comedy')}}                                               
            {{Form::checkbox('genre', 'Romantic Comedy',false)}}

            {{Form::label('genre', 'Science')}}                                               
            {{Form::checkbox('genre', 'Science',false)}}

            {{Form::label('genre', 'Musical')}}                                               
            {{Form::checkbox('genre', 'Musical',false)}}

            {{Form::label('genre', 'Film Noir')}}                                               
            {{Form::checkbox('genre', 'Film Noir',false)}}

            {{Form::label('genre', 'Fantasy')}}                                               
            {{Form::checkbox('genre', 'Fantasy',false)}}

            {{Form::label('genre', 'Indie')}}                                               
            {{Form::checkbox('genre', 'Indie',false)}}

            {{Form::label('genre', 'Family')}}                                               
            {{Form::checkbox('genre', 'Family',false)}}

            {{Form::label('genre', 'Anime')}}                                               
            {{Form::checkbox('genre', 'Anime',false)}}

            {{Form::label('genre', 'Mysterie')}}                                               
            {{Form::checkbox('genre', 'Mysterie',false)}}

            {{Form::label('genre', 'Parody')}}                                               
            {{Form::checkbox('genre', 'Parody',false)}}

            {{Form::label('genre', 'Other')}}                                               
            {{Form::checkbox('genre', 'Other',['class'=> 'form-control'])}}
        </div>

        <div class="form-group">
            <b>{{Form::label('score', 'Score:')}}</b>                                               
            {{Form::text('score', '',['class'=> 'form-control', 'placeholder'=>'Score'])}}
        </div>

        <div class="form-group">
            <b>{{Form::label('comments', 'Comments:')}}</b>
            {{Form::textarea('comments', '',['id'=>'article-ckeditor','class'=> 'form-control', 'placeholder'=>'Write your comment...'])}}
        </div>
        
        <!-- 
            |'Submit' is de value. Wanneer we op "submit" klikken komt er een 
            |post request naar de store functie van de controllers. 
        -->
        
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        <br><br><br>
    {!! Form::close() !!}
@endsection