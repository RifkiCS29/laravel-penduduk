@extends('layouts.global')

@section('title') Create Region @endsection

@section('content')
    <div class="col-md-8">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif 
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('regions.store')}}" method="POST">

            @csrf
            <label for="name">Region Name</label><br>
            <input type="text" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" value="{{old('name')}}" name="name" id="name" placeholder="region name"/>
            <div class="invalid-feedback">
                {{$errors->first('name')}}
            </div>
            <br>

            <input type="submit" class="btn btn-primary" value="Save"/>

        </form>
    </div>
@endsection