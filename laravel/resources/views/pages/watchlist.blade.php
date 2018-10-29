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
                                <div class="form-group">
                                <label><b>Add Movie: </b></label>
                                <input type="text" name="title" value="" placeholder="Movie Titel..."><br>
                                </div>

                                <div class="form-group">
                                <label><b>Add Genre: </b></label>
                                <input type="text" name="genre" value="" placeholder="Movie Genre..."><br>
                                </div>
                                
                            <input type="submit">
                            <br>
                            <br>
                        {!! Form::close() !!}
                    </div>
                        <h3> Your WatchList </h3>

                        @if (count($names)>0)
                            <table class="table table-striped">
                                
                                <tr>
                                    <th>FilmNaam</th>
                                    <th>Genre</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                
                                <!-- Loop door alle posts van de user -->
                                @foreach($names as $movieName)
                                <tr>
                                    <td>{{$movieName->title}}</td>
                                    <td>{{$movieName->genre}}</td>
                                    <td><a href="/watchlist/{{$movieName->id}}/edit" class="btn btn-default">Edit</a></td>
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
