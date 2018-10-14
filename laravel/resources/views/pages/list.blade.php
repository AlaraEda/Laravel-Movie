<!-- Bekeken Films Pagina -->

@extends('layouts.app')

@section('content')
    <h1>Already Watched Movies</h1>
    
<div class="container">
    <div class="row justify-content-center">
        <p>In here you can find a  list of all the movies I've watched on alphateical order.</p>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Watched Movies</div>
                <a href="/list/create" class="btn btn-primary">Add Movies</a>
                <div class="card-body">

                    <h3> Count by title</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Score</th>
                            <th>Comments</th>
                        </tr>

                        <!-- Loop door alle posts van de user -->
                        @foreach($movies as $movie)  <!-- De variabele van het model is $movies genoemd -->
                        <tr>
                            <td>{{$movie->status}}</td>
                            <td>{{$movie->title}}</td>
                            <td>{{$movie->genre}}</td>
                            <td>{{$movie->score}}</td>
                            <td>{{$movie->comments}}</td>
                            <td><a href="/list/{{$movie->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>
                                {!!Form::open(['action'=>['MoviesController@destroy',$movie->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('X',['class'=> 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                        @endforeach

                    </table>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
