@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <br>

    <div>
        <!-- Als je het tussen haakjes zet dan zie je het in HTML code met de uitroeptekens zie je het op de normale manier -->
        {!!$post->body!!}
    </div>
    <hr><!--Linebreak -->
    <small>Written on {{$post->created_at}}</small>
@endsection