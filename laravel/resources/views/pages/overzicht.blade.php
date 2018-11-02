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

    <br><br>
    <div class="col-md-4">                                                                                  <!-- 1 Card aanmaak is 4 col's lang waardoor er 3 naast elkaar past. Daarna gaat het noodgedwongen naar een volgende regel. -->
          <div class="card bg-light mb-3" style="max-width: 23rem;">                                        <!-- Card in de vrijgemaakte col stoppen -->
            <div class="card-header text-white bg-dark mb-3"></div>                                         <!-- Card name -->
            <div class="card-body">                                                                         <!-- De meegegeven variabele in controller -->
              @foreach($movies as $movie)   
                <div class="row">
                    <div class="col-s4">
                      {!!Form::open(['action'=>['MoviesController@flip', $movie->id], 'method'=> 'POST', 'enctype'=> 'multipart/form-data'])!!}
                          {{Form::submit('Not Watched',['class'=> 'btn btn-primary'])}}
                      {!!Form::close()!!}                      
                    </div>
                    <div class="col-s4">
                      <a href="/overzicht/{{$movie->id}}">{{$movie->title}}</a>                                 <!-- Movie naam in de database -->                                                                                                            
                    </div>

                    <div class="col-s4"> 
                      <a href="/overzicht/{{$movie->id}}/edit" class="btn btn-default">Edit</a>
                    </div>
                </div>
                <br>
              @endforeach  
            </div>
          </div>
    </div>    
    <br> 
  </div>                                                                                         
@endsection
