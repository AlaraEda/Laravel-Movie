<!-- Content van create-page voor posts-->
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
            {{Form::label('title', 'Title:')}}                                               

            <!--
            |---------------------------------------------------------------------------------------
            |'' is leeg omdat het een createform is. We willen geen value die erin staat 
            |dus word het een lege string daarna stoppen we attributen in de array (zoals de class 
            |form-control wat een bootstrap class is) zonder form-control word het vakje klein
            |----------------------------------------------------------------------------------------
            -->
            {{Form::text('title', '',['class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>

        <div class="form-group">
            {{Form::label('genre', 'Genre:')}}                                               
            {{Form::text('genre', '',['class'=> 'form-control', 'placeholder'=>'Genre'])}}
        </div>

        <div class="form-group">
            {{Form::label('score', 'Score:')}}                                               
            {{Form::text('score', '',['class'=> 'form-control', 'placeholder'=>'Score'])}}
        </div>

        <div class="form-group">
            {{Form::label('comments', 'Comments:')}}
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