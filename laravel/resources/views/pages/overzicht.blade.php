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
      <button class="btn btn-primary sm" type="submit">Search</button>
    {!! Form::close() !!}

  <br><br>

  <div class="row">
    {!! Form::open(['url' => '/filter', 'method'=>'POST', 'role'=>'filter']) !!}
      <div class="btn-group btn-group-toggle" data-toggle="buttons" name="filter">
        <label class="btn btn-secondary active" name="filter" >
          <input type="radio" name="filter" value='A' id="option1" autocomplete="off"> A
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="B" value='B' id="option2" autocomplete="off"> B
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="C" value='C' id="option3" autocomplete="off"> C
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="D" value='D' id="option4" autocomplete="off"> D
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="E" value='E' id="option5" autocomplete="off"> E
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="F" value='F' id="option6" autocomplete="off"> F
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="G" value='G' id="option7" autocomplete="off"> G
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="H" value='H' id="option8" autocomplete="off"> H
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="I" value='I' id="option9" autocomplete="off"> I
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="J" value='J' id="option10" autocomplete="off"> J
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="K" value='K' id="option11" autocomplete="off"> K
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="L" value='L' id="option12" autocomplete="off"> L
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="M" value='M' id="option13" autocomplete="off"> M
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="N" value='N' id="option14" autocomplete="off"> N
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="O" value='O' id="option15" autocomplete="off"> O
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="P" value='P' id="option16" autocomplete="off"> P
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="Q" value='Q' id="option17" autocomplete="off"> Q
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="R" value='R' id="option18" autocomplete="off"> R
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="S" value='S' id="option19" autocomplete="off"> S
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="T" value='T' id="option20" autocomplete="off"> T
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="U" value='U' id="option21" autocomplete="off"> U
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="V" value='V' id="option22" autocomplete="off"> V
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="W" value='W' id="option23" autocomplete="off"> W
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="X" value='X' id="option24" autocomplete="off"> X
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="Y" value='Y' id="option25" autocomplete="off"> Y
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="Z" value='Z' id="option26" autocomplete="off"> Z
        </label>
        <label class="btn btn-secondary">
          <input type="radio" name="#" value='#' id="option27" autocomplete="off"> #
        </label>
      </div>
      <button class="btn btn-primary sm" type="submit">Search</button>
    {!! Form::close() !!}

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
