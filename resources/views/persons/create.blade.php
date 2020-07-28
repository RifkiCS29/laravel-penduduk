@extends('layouts.global')

@section('title') Create person @endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif 
            <form class="shadow-sm p-3 bg-white" action="{{route('persons.store')}}" method="POST" enctype="multipart/form-data">

                @csrf
                <label for="name">Nama Penduduk</label><br>
                <input value="{{old('name')}}" type="text" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="Nama Penduduk" name="name" id="name"/>
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
                <br>
      
                <label for="description">Alamat</label><br>
                <textarea name="address" id="address" class="form-control {{$errors->first('address') ? "is-invalid" : ""}}" placeholder="Masukkan Alamat">{{old('address')}}</textarea>
                <div class="invalid-feedback">
                    {{$errors->first('address')}}
                </div>
                <br>

                <label for="region">Region</label><br>
                <select name="regions" id="regions" class="form-control {{$errors->first('regions') ? "is-invalid" : ""}}"></select>
                <div class="invalid-feedback">
                    {{$errors->first('regions')}}
                </div>
                <br><br>

                <label for="income">Gajih</label><br>
                <input value="{{old('income')}}" type="number" class="form-control {{$errors->first('income') ? "is-invalid" : ""}}" name="income" id="income"/>
                <div class="invalid-feedback">
                    {{$errors->first('income')}}
                </div>
                <br>

                <input type="submit" class="btn btn-primary" value="Save"/>
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
</script>
<script>
    CKEDITOR.replace('address',{
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    });
</script>
@endsection