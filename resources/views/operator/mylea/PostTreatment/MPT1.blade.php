@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-1</li>
        </ol>
    </nav>
</section>

<section class="m-5">
@foreach($MPT1 as $data)
    <h3>Post Treatment 1 : {{$data['KodeProduksi']}}</h3>
    <table class="table">
        <tr>
            <th>Proses</th>
            <th>Status</th>
            <th>Tanggal Pengerjaan</th>
        </tr>
        <tr>
            <td>Washing</td>
            @if($data['StatusWashing']==NULL)
                <td>Belum dikerjakan</td>
            @else
                <td>Sudah dikerjakan</td>
            @endif
            @if($data['TanggalWashing']==NULL)
                <td> - </td>
            @else
                <td>{{$data['TanggalWashing']}}</td>
            @endif
            <td><a href="{{route('MPT1-Report-Submit', ['id'=>$data['id'], 'case'=>'Washing'])}}">Kerjakan</a></td>
        </tr>
        <tr>
            <td>Pengerikan</td>
            @if($data['StatusPengerikan']==NULL)
                <td>Belum dikerjakan</td>
            @else
                <td>Sudah dikerjakan</td>
            @endif
            @if($data['TanggalPengerikan']==NULL)
                <td> - </td>
            @else
                <td>{{$data['TanggalPengerikan']}}</td>
            @endif
            <td><a href="{{route('MPT1-Report-Submit', ['id'=>$data['id'], 'case'=>'Pengerikan'])}}">Kerjakan</a></td>
        </tr>
        <tr>
            <td>Scoring & Dyeing</td>
            @if($data['StatusScoringDyeing']==NULL)
                <td>Belum dikerjakan</td>
            @else
                <td>Sudah dikerjakan</td>
            @endif
            @if($data['TanggalScoringDyeing']==NULL)
                <td> - </td>
            @else
                <td>{{$data['TanggalScoringDyeing']}}</td>
            @endif
            <td><a href="{{route('MPT1-Report-Submit', ['id'=>$data['id'], 'case'=>'ScoringDyeing'])}}">Kerjakan</a></td>
        </tr>
        <tr>
            <td>Washing & Drying</td>
            @if($data['StatusWashingDrying']==NULL)
                <td>Belum dikerjakan</td>
            @else
                <td>Sudah dikerjakan</td>
            @endif
            @if($data['TanggalWashingDrying']==NULL)
                <td> - </td>
            @else
                <td>{{$data['TanggalWashingDrying']}}</td>
            @endif
            <td><a href="{{route('MPT1-Report-Submit', ['id'=>$data['id'], 'case'=>'WashingDrying'])}}">Kerjakan</a></td>
        </tr>
        <tr>
            <td>PEG & Drying</td>
            @if($data['StatusPEGDrying']==NULL)
                <td>Belum dikerjakan</td>
            @else
                <td>Sudah dikerjakan</td>
            @endif
            @if($data['TanggalPEGDrying']==NULL)
                <td>-</td>
            @else
                <td>{{$data['TanggalPEGDrying']}}</td>
            @endif
            <td><a href="{{route('MPT1-Report-Submit', ['id'=>$data['id'], 'case'=>'PEGDrying'])}}">Kerjakan</a></td>
        </tr>
    </table>
@endforeach
</section>
@endsection