<!-- 
|Overzicht Films Pagina 
|Je krijgt toegang tot de $movies variabele omdat dat aan je word meegegeven in de MoviesController.
-->

@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <div class="row justify-content-center">
    <div class="col">
      <h1>Overzicht Watched Movies <a class="btn btn-light" href="/overzicht/create" role="button">Create</a></h1>
    </div>
    
    
    
    <div class ="col-md-auto">
      <!-- Quick Movie Add -->
      {!!Form::open(['action'=>'MoviesController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
          <div class="form-group">
              <label><b>Add Movie: </b></label>
              <input type="text" name="title" value="" placeholder="Movie Titel..."><br>
          </div>
      {!!Form::close()!!}
    </div>
  </div>

  <br>
  <br>
  
  <div class="row justify-content-center">
    
    {!! Form::open(['url' => '/filter', 'method'=>'POST', 'role'=>'filter']) !!}
      <div class="btn-group btn-group-toggle" data-toggle="buttons" name="filter">
        <label class="btn btn-dark" name="filter" >
          <input type="radio" name="filter" value='ALLES' id="option1" autocomplete="off" active> ALL
        </label>
        <label class="btn btn-secondary" name="filter" >
          <input type="radio" name="filter" value='A' id="option1" autocomplete="off"> A
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='B' id="option2" autocomplete="off"> B
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='C' id="option3" autocomplete="off"> C
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='D' id="option4" autocomplete="off"> D
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='E' id="option5" autocomplete="off"> E
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='F' id="option6" autocomplete="off"> F
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='G' id="option7" autocomplete="off"> G
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='H' id="option8" autocomplete="off"> H
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='I' id="option9" autocomplete="off"> I
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='J' id="option10" autocomplete="off"> J
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='K' id="option11" autocomplete="off"> K
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='L' id="option12" autocomplete="off"> L
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='M' id="option13" autocomplete="off"> M
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='N' id="option14" autocomplete="off"> N
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='O' id="option15" autocomplete="off"> O
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='P' id="option16" autocomplete="off"> P
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='Q' id="option17" autocomplete="off"> Q
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='R' id="option18" autocomplete="off"> R
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='S' id="option19" autocomplete="off"> S
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='T' id="option20" autocomplete="off"> T
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='U' id="option21" autocomplete="off"> U
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='V' id="option22" autocomplete="off"> V
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='W' id="option23" autocomplete="off"> W
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='X' id="option24" autocomplete="off"> X
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='Y' id="option25" autocomplete="off"> Y
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="filter" value='Z' id="option26" autocomplete="off"> Z
        </label>
        <label class="btn btn-dark">
          <input type="radio" name="filter" value=' ' id="option27" autocomplete="off"> #
        </label>
      </div>
      <button class="btn btn-light" type="submit">Search</button>
    {!! Form::close() !!}
    </div>
    <br>
    <br>

    <div class="row justify-content-center">
      <div class="card bg-light mb-3">                                        <!-- Card in de vrijgemaakte col stoppen -->
        <div class="card-header text-white bg-dark mb-3">
          <center>
            {!!Form::open(['action'=>'MoviesController@search', 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
              <div class="btn-group btn-group-toggle" data-toggle="buttons" name="search">
                  <label class="btn btn-dark" name="search">
                  <input type="text" placeholder="Search..." name="search" value='' id="option1" autocomplete="off" active>
                  </label>
              </div>
              
            <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
            {!! Form::close() !!}
          </center>
        </div>                                         <!-- Card name -->
        <div class="card-body">                                                                         <!-- De meegegeven variabele in controller -->

            <table class="table table-borderless">
              <thead></thead>
              <tbody>
                @foreach($movies as $movie)   
                <tr>
                  <td scope="row"> 
                    {!!Form::open(['action'=>['MoviesController@flip', $movie->id], 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
                        {{Form::submit('Not Watched',['class'=> 'btn btn-dark'])}}
                    {!!Form::close()!!}    
                  </td>
                  <th scope="row">
                    <a href="/overzicht/{{$movie->id}}">{{$movie->title}}</a>                                 <!-- Movie naam in de database -->
                  </th>
                  <td scope="row">{{$movie->score}}</td>
                  <th scope="row">
                    <a class="btn btn-primary" href="/overzicht/{{$movie->id}}/edit" role="button">Edit</a>
                  </th>
                  <td>
                      {!!Form::open(['action'=>['MoviesController@destroy',$movie->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
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
    
    <br> 
  </div>                                                                                         
@endsection
