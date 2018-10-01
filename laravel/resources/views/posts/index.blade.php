@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <!--Als er posts zijn in de db-->
    @if(count($posts)>1)
        @foreach($posts as $post)
            <!-- Bootstrap class= well -->
            <div class="well">
                <h3>{{$post->title}}</h3>
                </div>
        @endforeach

    @else
        <p>No Posts found</p>
    @endif
@endsection