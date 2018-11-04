@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class ="col-md-auto">
                        <!-- Quick Movie Add -->
                        {!! Form::open(['action'=>'WatchlistController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                                <div class="form-group col-4">
                                    <label><b>Add Movie: </b></label>
                                    <input type="text" name="title" value="" placeholder="Movie Titel..."><br>
                                </div>

                                <div class="form-group col-4">
                                    <label><b>Add Genre: </b></label>
                                    <input type="text" name="genre" value="" placeholder="Movie Genre..."><br>
                                </div>

                                <div class= 'col-4'>
                                    <br>
                                    <input type="submit">
                                </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <br>
                    <br>
                        <h3> Your WatchList </h3>

                        @if (count($names)>0)
                            <table class="table table-striped">
                                
                                <tr>
                                    <th>Status</th>
                                    <th>FilmNaam</th>
                                    <th>Genre</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                
                                <!-- Loop door alle posts van de user -->
                                @foreach($names as $movieName)
                                <tr>
                                    <td>
                                        {!!Form::open(['action'=>['WatchlistController@flip', $movieName->id], 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
                                            {{Form::submit('Watched',['class'=> 'btn btn-dark'])}}
                                        {!!Form::close()!!}
                                    </td>
                                    <td><a href="/watchlist/{{$movieName->id}}">{{$movieName->title}}</a></td>                              <!-- Movie naam in de database -->
                                    <td>{{$movieName->genre}}</td>
                                    <td><a class="btn btn-primary" href="/watchlist/{{$movieName->id}}/edit" role="button">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action'=>['WatchlistController@destroy',$movieName->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('X',['class'=> 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no movies</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
