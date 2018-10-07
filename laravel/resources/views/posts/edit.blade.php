<!-- Edit Layout-content -->
@extends('layouts.app')

@section('content')
    <br>
    <h1>Edit Post</h1>
    <!--
    |-------------------------------------------------------------- 
    |De actie word doorgestuurd naar de functie update van 
    |PostController.Het staat in een array omdat het belangerijk 
    |is om te weten welke post (met welke id) word geupdate
    |--------------------------------------------------------------
    -->
    {!! Form::open(['action'=>['PostsController@update', $post->id], 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        
        <div class="form-group">
            <!-- De labelnaam is title. De echte tekst word Title-->
            {{Form::label('title', 'Title:')}}

            <!--Je wilt weten weten wat de titel is van de post aangezien je dat wilt aanpassen.-->
            {{Form::text('title',$post->title ,['class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>

        <div class="form-group">
           <!-- Je wilt weten wat de oude body van de post is aangezien je dat wilt aanpassen.-->
            {{Form::label('body', 'Body:')}}
            {{Form::textarea('body', $post->body,['id'=>'article-ckeditor','class'=> 'form-control', 'placeholder'=>'Body Text'])}}
        </div>

        <div class="form-group">
            <!-- Cover_image is hoe de file heet. Wanneer je een file stuurt moet je een link-type -->
            {{Form::file('cover_image')}} 
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