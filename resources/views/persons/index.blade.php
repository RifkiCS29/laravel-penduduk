@extends('layouts.global')

@section('title') persons List @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">
                  {{session('status')}}
                </div>
            @endif
            <form  action="{{route('persons.index')}}">
                <div class="row">
                    <div class="col-md-6">
                        <select name="regions" id="regions" class="form-control"></select>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
                <hr class="my-3">
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="{{route('persons.create')}}" class="btn btn-primary">Create person</a>
                </div>
            </div>
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th><b>Nama Penduduk</b></th>
                        <th><b>Gajih</b></th>
                        <th><b>Daerah</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($persons as $person)
                        <tr>
                            <td>{{$person->name}}</td>
                            <td>Rp. {{number_format($person->income)}}</td>
                            <td>{{$person->region->name}}</td>
                            <td>
                                <a href="{{route('persons.edit',['id'=>$person->id])}}" class="btn btn-info btn-sm">Edit</a>
                                <form method="POST" class="d-inline" onsubmit="return confirm('Move person To Trash ?')" action="{{route('persons.destroy',['id'=>$person->id])}}">
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
                        <td colspan="10">
                            {{$persons->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
        $('#regions').select2({
          ajax: {
            url: 'http://localhost:8000/ajax/regions/search',
            processResults: function(data){
              return {
                results: data.map(function(item){return {id: item.id, text: item.name} })
              }
            }
          }
        });
</script>
@endsection