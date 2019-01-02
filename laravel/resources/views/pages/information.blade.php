<!-- 
|Overzicht Bekeken Films Pagina 
|Je krijgt toegang tot de $movies variabele omdat dat aan je word meegegeven in de MoviesController.

Pagina waar je verschillende informatie kan vinden over allerlei users. 
-->

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
    <center><h1>Created Users</h1></center>
    <br>
    <div class="row justify-content-center">

            <div class="card">
                <div class="card-header"><b>All Users</b></div>
                <div class="card-body">
                    <div class= "row">
                        
                        <div class="col-sm">
                        <h3> Order by alphatical order </h3>
                        </div>

                        <div class= "col-s6">
                            {!!Form::open(['action'=>'InformationController@indexSearch', 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
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
                                    <th class="scope">User</th>
                                    <th class="scope">E-mail</th>
                                    <th class="scope">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop door alle posts van de user -->
                                @foreach($users as $user)  <!-- De variabele van het model is $movies genoemd -->
                                <tr>
                                    <!--<a class="nav-link" href="/overzicht"></a> -->
                                    <td><a href="/information/{{$user->id}}">{{$user->name}}</a></td>  
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">
                                        {!!Form::open(['action'=>['InformationController@destroy',$user->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
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
