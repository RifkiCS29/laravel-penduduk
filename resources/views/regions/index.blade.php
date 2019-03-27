@extends('layouts.global')
@section('title') Region List @endsection

@section('content')

    @if(session('status'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            </div>
        </div>
    @endif 
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{route('regions.create')}}" class="btn btn-primary">Create Region</a>
        </div> 
    </div>
    <br>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($regions as $region)
                        <tr>
                            <td>{{$region->name}}</td>
                            <td> 
                                <a href="{{route('regions.edit', ['id'=>$region->id])}}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{route('regions.show',['id'=>$region->id])}}" class="btn btn-primary btn-sm">Detail</a>
                                <form onsubmit="return confirm('Delete Region ?')" class="d-inline" action="{{route('regions.destroy',['id'=>$region->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                                </form>
                            </td>    
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colSpan="10">
                            {{$regions->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection