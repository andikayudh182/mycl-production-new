@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Post Treatment Mylea</h3>
    <table class="table">
        <tr>
            <th>Kode Produksi</th>
            <th>Arrival Date</th>
            <th>Jenis Mylea</th>
            <th>Jumlah</th>
        </tr>
        @foreach($QualityControl1 as $data)
        <tr>
            <td>{{$data['KodeProduksi']}}</td>
            <td>{{$data['ArrivalDate']}}</td>
            <td>{{$data['JenisMylea']}}</td>
            <td>{{$data['GradeA']+$data['GradeE']}}</td>
            <td><a href="{{route('MPT1', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-1</a></td>
            <td><a href="{{route('MPT2', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-2</a></td>
            <td><a href="{{route('MPT3', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-3</a></td>
            <td><a href="{{route('MPT4', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-4</a></td>
        </tr>
        @endforeach
    </table>
</section>
@endsection