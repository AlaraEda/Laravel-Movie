@extends('layouts.app')

@section('content')
    <h1>Already Watched Movies</h1>
    

<div class="container">
    
    <div class="row justify-content-center">
        <p>In here you can find a  list of all the movies I've watched on alphateical order.</p>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Watched Movies</div>

                <div class="card-body">
                        <h3> Count by title</h3>
                            <table class="table table-striped">
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Score</th>
                                    <th>Comments</th>
                                </tr>
                            </table>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
