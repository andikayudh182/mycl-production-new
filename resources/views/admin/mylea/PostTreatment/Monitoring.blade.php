@extends('layouts.admin')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Post Treatment Mylea</h3>
    <table class="table">
        <tr>
            <th>Kode Produksi</th>
            <th>Kode Mylea</th>
            <th>Arrival Date</th>
            <th>Jenis Mylea</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
        @foreach($QualityControl1 as $data)
        <tr>
            <td>{{$data['KodeProduksi']}}</td>
            <td>{{$data['KPMylea']}}</td>
            <td>{{$data['ArrivalDate']}}</td>
            <td>{{$data['JenisMylea']}}</td>
            <td>{{$data['GradeA']+$data['GradeE']}}</td>
            <td>
                @if($data['Status']==NULL)
                    Belum Selesai                 
                @else
                    Sudah Selesai
                @endif
            </td>
            <td><a href="{{route('MPT1', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-1</a></td>
            <td><a href="{{route('MPT2', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-2</a></td>
            <td><a href="{{route('MPT3', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-3</a></td>
            <td><a href="{{route('MPT4', ['KodeProduksi'=>$data['KodeProduksi'],])}}">MPT-4</a></td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {!! $QualityControl1->links() !!}
    </div>
</section>
@endsection