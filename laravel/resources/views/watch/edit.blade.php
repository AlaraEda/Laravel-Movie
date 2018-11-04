<!-- Edit Layout-content, je word hier naar toe gestuurd doormiddel van de MoviesController. -->
@extends('layouts.app')

@section('content')
    <br>
    <h1>Edit Post</h1>
    <!--
    |-------------------------------------------------------------- 
    |De actie word doorgestuurd naar de functie update van 
    |MoviesController. Het staat in een array omdat het belangerijk 
    |is om te weten welke post (met welke id) word geupdate
    |--------------------------------------------------------------
    -->
    {!! Form::open(['action'=>['WatchlistController@update', $watch->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        
        <div class="form-group">
            <!-- De labelnaam is title. De echte tekst word Title-->
            <b>{{Form::label('title', 'Title:')}}</b>

            <!--Je wilt weten weten wat de titel is van de post aangezien je dat wilt aanpassen.-->
            {{Form::text('title',$watch->title ,['class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>

        <div class="form-group">
            <b>{{Form::label('genre', 'Genre:')}}</b>
            {{Form::text('genre',$watch->genre ,['class'=> 'form-control', 'placeholder'=>'Genre'])}}
        </div>

        <div class="form-group">
            <b>{{Form::label('comments', 'Comments:')}}</b>
            {{Form::textarea('comments', $watch->comments,['id'=>'article-ckeditor','class'=> 'form-control', 'placeholder'=>'Comment Text'])}}
        </div>

        <!-- 
        |-----------------------------------------------------------------
        |'Submit' is de value. Wanneer we op "submit" klikken komt er 
        | een post request naar de store functie van de controllers.
        |------------------------------------------------------------------
        -->
        {{Form::hidden('_method','PUT')}}                          
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}   
    {!! Form::close() !!}
@endsection