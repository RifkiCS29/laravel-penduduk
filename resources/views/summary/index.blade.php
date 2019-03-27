@extends('layouts.global')

@section('title') Summary @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-stripped table-bregioned">
                <thead>
                    <tr>
                        <th><b>Nama Daerah</b></th>
                        <th><b>Jumlah Penduduk</b></th>
                        <th><b>Total Pendapatan</b></th>
                        <th><b>Pendapatan Rata-Rata</b></th>
                        <th><b>Pendapatan Rata-Rata</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regions as $region)
                        <tr>
                            <td>{{$region->name}}</td>
                            <td>{{$region->persons->count()}} orang</td>
                            <td>Rp. {{number_format($region->persons->sum('income'))}}</td>
                            <td>Rp. {{number_format($region->persons->avg('income'))}}</td>
                            <td>
                                @if ($region->persons->avg('income') <= 1700000) 
                                    <span class="badge bg-danger text-light">SIAGA</span>
                                @elseif ($region->persons->avg('income') > 1700000 && $region->persons->avg('income') < 2200000) 
                                    <span class="badge bg-warning text-light">WASPADA</span>
                                @elseif ($region->persons->avg('income') >= 2200000) 
                                    <span class="badge bg-success text-light">AMAN</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            {{$regions->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
