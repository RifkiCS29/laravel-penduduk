@extends('layouts.global')

@section('title')Detail Region @endsection

@section('content')

<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Region Name : </b> <br>
            {{$region->name}}
            <br><br>
        </div>
    </div>
</div>
    
@endsection