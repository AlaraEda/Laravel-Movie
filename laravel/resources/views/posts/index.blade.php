<!-- Het eerste wat je ziet als je op Posts klikt -->
@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <br>
    <!--Als er posts zijn in de db-->
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">

                    <!-- Links Afbeeldingen -->
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    
                    <!--Rechts Tekst-->
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                    
                </div>
                <br>
            </div>
        @endforeach

        <!--Creeert pagina-wissel (1,2,3 etc...) bij meer dan 10 posts -->
        {{$posts->links()}}

    @else
        <p>No Posts found</p>
    @endif
@endsection