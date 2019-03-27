@extends('layouts.global')

@section('title') Edit Region @endsection

@section('content')
    <div class="col-md-8">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('regions.update', ['id'=>$region->id])}}" method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">

        <label for="name">Region Name</label>
        <input value="{{old('name') ? old('name') : $region->name}}" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="region name" type="text" name="name" id="name"/>
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
        <br>

        <input class="btn btn-primary" type="submit" value="Update"/>
    </form>

    </div>
@endsection