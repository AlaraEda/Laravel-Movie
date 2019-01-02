<!-- 
|Overzicht Bekeken Films Pagina 
|Je krijgt toegang tot de $movies variabele omdat dat aan je word meegegeven in de MoviesController.

Pagina waar je verschillende informatie kan vinden over allerlei users. 
-->

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
    <center><h1>User Posts</h1></center>
    <br>
    <div class="row justify-content-center">

            <div class="card">
                <div class="card-header"><b>Watched Movies</b></div>
                
                <a href="/informatie/create" class="btn btn-dark">Add Movies +</a>
                <div class="card-body">
                    <div class= "row">
                        
                        <div class="col-sm">
                        <h3> Order by Creating </h3>
                        </div>

                        <div class= "col-s6">
                            {!!Form::open(['url'=>'/information/id/search', 'method'=> 'GET', 'enctype'=> 'multipart/form-data'])!!}
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

                    <div class="row">
                        <table class ="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="scope">Status</th>
                                    <th class="scope">Title</th>
                                    <th class="scope">Genre</th>
                                    <th class="scope">Score</th>
                                    <th class="scope">Comments</th>
                                    <th class="scope">Created</th>
                                    <th class="scope">Updated</th>
                                    <th class="scope">User</th>
                                    <th class="scope">Edit</th>
                                    <th class="scope">Delete</th>
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
                                    <td scope="row">{{$movie->created_at}}</td>
                                    <td scope="row">{{$movie->updated_at}}</td>
                                    <td scope="row">{{$movie->user->name}}</td>
                                    <td scope="row"><a class="btn btn-primary" href="/information/{{$movie->id}}/edit" role="button">Edit</a></td>
                                    <td scope="row">
                                        {!!Form::open(['action'=>['InformationController@destroy',$movie->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('X',['class'=> 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
