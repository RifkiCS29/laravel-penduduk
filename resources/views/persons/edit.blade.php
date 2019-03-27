@extends('layouts.global')

@section('title')Edit person @endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            
            <form enctype="multipart/form-data" method="POST" action="{{route('persons.update',['id'=>$person->id])}}" class="p-3 shadow-sm bg-white">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                
                <label for="name">Nama Penduduk</label><br>
                <input type="text" value="{{old('name') ? old('name') : $person->name}}" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="Nama Penduduk" name="name" id="name"/>
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
                <br>


                <label for="address">Alamat</label><br>
                <textarea name="address" id="address" class="form-control {{$errors->first('address') ? "is-invalid" : ""}}" placeholder="Masukkan Alamat">{{old('address') ? old('address') : $person->address}}</textarea>
                <div class="invalid-feedback">
                    {{$errors->first('address')}}
                </div>
                <br>

                <label for="region">Region</label><br>
                <select name="regions" id="regions" class="form-control"></select>
                <br><br>

                <label for="income">Gajih</label><br>
                <input type="number" class="form-control {{$errors->first('income') ? "is-invalid" : ""}}" value="{{old('income') ? old('income') : $person->income}}" name="income" id="income"/>
                <div class="invalid-feedback">
                    {{$errors->first('income')}}
                </div>
                <br>
                <br>

                <input type="submit" class="btn btn-primary" value="Update"/>
            </form>
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

        var region = {!! $person->region !!}


            var option = new Option(region.name, region.id, true, true);
            $('#regions').append(option).trigger('change');
</script>
@endsection