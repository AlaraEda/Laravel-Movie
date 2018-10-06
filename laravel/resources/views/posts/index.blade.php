@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <br>
    <!--Als er posts zijn in de db-->
    @if(count($posts)>0)
        @foreach($posts as $post)
            <!-- Bootstrap class= well -->
            <div class="well">
                <!-- De "show" functie word geladen maar er is daar niks.-->
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on {{$post->created_at}}by {{$post->user->name}}</small>
            </div>
        @endforeach

        <!--Creeert pagina wissel -->
        {{$posts->links()}}

    @else
        <p>No Posts found</p>
    @endif
@endsection