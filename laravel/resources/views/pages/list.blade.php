<!-- 
|Overzicht Bekeken Films Pagina 
|Je krijgt toegang tot de $movies variabele omdat dat aan je word meegegeven in de MoviesController.
-->

@extends('layouts.app')

@section('content')
<h1>Already Watched Movies</h1>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
    <div class="row justify-content-center">
        <p>In here you can find a  list of all the movies I've watched on alphateical order.</p>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Watched Movies</div>
                <a href="/list/create" class="btn btn-primary">Add Movies</a>
                <div class="card-body">
                    <div class= "row">
                        <div class="col">
                        <h3> Count by title</h3>
                        </div>
                        <div class= "col">
                            {!!Form::open(['action'=>'MoviesController@search', 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
                            <div class="btn-group btn-group-toggle" data-toggle="buttons" name="search">
                                <label class="btn btn-dark" name="search">
                                <input type="text" placeholder="Search..." name="search" value='' id="option1" autocomplete="off" active>
                                </label>
                            </div>
                            
                            <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                    <br>

                    <table class ="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Title</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Score</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop door alle posts van de user -->
                            @foreach($movies as $movie)  <!-- De variabele van het model is $movies genoemd -->
                            <tr>
                                <td scope="row">{{$movie->status}}</td>
                                <td scope="row">{{$movie->title}}</td>
                                <td scope="row">{{$movie->genre}}</td>
                                <td scope="row">{{$movie->score}}</td>
                                <td scope="row">{{$movie->comments}}</td>
                                <td scope="row"><a href="/list/{{$movie->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td scope="row">
                                    {!!Form::open(['action'=>['MoviesController@destroy',$movie->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('X',['class'=> 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
