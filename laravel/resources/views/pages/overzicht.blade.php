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
    <?php
      //variabelen
      $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','#');
      $cijfer = -1;
    ?> 
    @for($tabel = 0; $tabel<27; $tabel++)                                                                     <!-- Aantal tabellen-->
     <?php  $cijfer = $cijfer +1; ?>                                                                          <!-- Elke keer wanneer een tabel is aangemaakt doe +1 -->
    
      <div class="col-md-4">                                                                                <!-- 1 Card aanmaak is 4 col's lang waardoor er 3 naast elkaar past. Daarna gaat het noodgedwongen naar een volgende regel. -->
        <div class="card bg-light mb-3" style="max-width: 23rem;">                                          <!-- Card in de vrijgemaakte col stoppen -->
          <div class="card-header text-white bg-dark mb-3">{{$letters[$cijfer]}} </div>                     <!-- Card name -->
          <div class="card-body">
            @foreach($c as $mo)                                                                          <!-- De meegegeven variabele in controller -->
            @foreach($h as $movie)   
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
            @endforeach
          </div>
        </div>
      </div>

    @endfor
  </div>    
  <br>                                                                                          
@endsection
