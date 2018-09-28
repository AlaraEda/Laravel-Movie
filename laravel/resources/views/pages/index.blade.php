<!--De lay-out word uit de layouts folder gehaald -->
@extends('layouts.app')

@section('content')
    <div class= "jumbotron text-center">
        <h1><?php echo $title; ?></h1>
        <p>This is the Laravel application from the "Laravel from SCRATCH youtube series</p>
        <p><a class= "btn btin=primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-succes btn-lg" href="/register" role="button"> Register</a></p>
    </div>
    
@endsection
