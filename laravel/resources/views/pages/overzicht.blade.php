<!-- 
|Overzicht Films Pagina 
|Je krijgt toegang tot de $movies variabele omdat dat aan je word meegegeven in de MoviesController.
-->

@extends('layouts.app')

@section('content')

  <div class="row justify-content-center">
    <div class="col">
      <h1>Overzicht Watched Movies</h1>
    </div>
    <div class ="col-md-auto">
      <!-- Quick Movie Add -->
      {!! Form::open(['action'=>'MoviesController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
          <div class="form-group">
              <label><b>Add Movie: </b></label>
              <input type="text" name="title" value="" placeholder="Movie Titel..."><br>
          </div>
      {!! Form::close() !!}
    </div>
  </div>

  <br>
  <br>
  
  <div class="row">
    {!! Form::open(['url'=>'/filter', 'method'=>'POST', 'role'=>'filter']) !!}
        <select name = "filter">
          <option value="A">A</option>
          <option value="H">H</option>
        </select>
      <button class="btn btn-primary sm" id="button_search" type="submit">Search</button>
    {!! Form::close() !!}

  <br><br>

  <div class="col-md-4">                                                                               <!-- 1 Card aanmaak is 4 col's lang waardoor er 3 naast elkaar past. Daarna gaat het noodgedwongen naar een volgende regel. -->
        <div class="card bg-light mb-3" style="max-width: 23rem;">                                          <!-- Card in de vrijgemaakte col stoppen -->
          <div class="card-header text-white bg-dark mb-3"></div>                     <!-- Card name -->
          <div class="card-body">                                                                         <!-- De meegegeven variabele in controller -->
            @foreach($movies as $movie)   
              <div class="row">
                  <div class="col-6">
                    <a href="/overzicht/{{$movie->id}}">{{$movie->title}}</a>                                 <!-- Movie naam in de database -->                                                                                                            
                  </div>

                  <div class="col-6"> 
                    <a href="/overzicht/{{$movie->id}}/edit" class="btn btn-default">Edit</a>
                  </div>
              </div>
              <br>
            @endforeach  
          </div>
        </div>
  </div>    
  <br>                                                                                          
@endsection
