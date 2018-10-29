<!-- Het eerste wat je ziet als je op Shared Watchlist klikt -->
@extends('layouts.app')

@section('content')
    <h1>Shared Watchlist</h1>
    <br>
    <!--Als er posts zijn in de db-->
    @if(count($watchlist)>0)
        @foreach($watchlist as $watch)
            <div class="well">
                <div class="row">

                    <!-- Links Afbeeldingen -->

                    
                    <!--Rechts Tekst-->
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/sharedlist/{{$watch->id}}">{{$watch->title}}</a></h3>
                        <small>Written on {{$watch->created_at}} by {{$watch->user->name}}</small>
                    </div>
                    
                </div>
                <br>
            </div>
        @endforeach

        <!--Creeert pagina-wissel (1,2,3 etc...) bij meer dan 10 posts -->
        {{$watchlist->links()}}

    @else
        <p>No Posts found</p>
    @endif
@endsection