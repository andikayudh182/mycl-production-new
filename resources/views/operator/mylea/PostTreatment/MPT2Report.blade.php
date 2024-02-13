@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-2 Report</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($MPT2 as $data)
        <h3>{{$data['KodeProduksi']}}</h3>
        Grade :{{$data['Grade']}} <br>
        Details : {{$Details[0]['KategoriReinforce'].', '.$Details[0]['Warna']}}
        <table class="table mt-2">
            <tr>
                <th>Proses</th>
                <th>Status</th>
                <th>Tanggal Pengerjaan</th>
            </tr>
            <tr>
                <td>Reinforce & Drying</td>
                @if($data['StatusReinforceDrying'] == Null)
                    <td>Belum Dikerjakan</td>
                @else
                    <td>Sudah Dikerjakan</td>
                @endif
                <td>{{$data['TanggalReinforceDrying']}}</td>
                <td><a href="{{route('MPT2-Report-Submit', ['id'=>$data['id'], 'case'=>'ReinforceDrying'])}}">Kerjakan</a></td>
            </tr>
        </table>
    @endforeach
</section>
@endsection