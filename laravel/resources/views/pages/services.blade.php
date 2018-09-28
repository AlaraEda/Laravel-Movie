<!--basic html -->
@extends('layouts.app')

<!--Waar in de layouts.app de tekst gaat komen == content -->
@section('content')
        <!-- pagescontroller.php -->

        <h1>{{$title}}</h1>

        <!--Als meer dan 0 service data -->
        @if(count($services)>0)
                <ul class="list-group">

                <!-- Loop door alle data van "services" heen-->
                @foreach($services as $service)

                        <!-- Laat data zien -->
                        <li class="list-group-item">{{$service}}</li>
                        
                @endforeach

                </ul>
        @endif
@endsection

