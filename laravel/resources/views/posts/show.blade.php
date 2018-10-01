@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <br>

    <div>
        {{$post->body}}
    </div>
    <hr><!--Linebreak -->
    <small>Written on {{$post->created_at}}</small>
@endsection