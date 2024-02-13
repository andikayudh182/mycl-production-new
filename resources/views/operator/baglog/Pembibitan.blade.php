@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembibitan</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Pembibitan</h3>
    <table class="table">
        <tr>
            <th>Tanggal Sterilisasi</th>
            <th>No Batch</th>
            <th>Jumlah</th>
            <th></th>
        </tr>
        @foreach ( $Pembibitan as $Tanggal => $Batch)
        @foreach ($Batch as $NoBatch => $Value)
        <tr>
            <?php 
                $Jumlah = '0';
                $Status = '0';
                $sterilisasi_id = '';
            ?>
            @foreach ($Value as $data )
            <?php
                $Jumlah = $Jumlah + $data['Jumlah'];
                $Status = $data['Status'];
                $sterilisasi_id = $sterilisasi_id.$data['id'].', ';
            ?>
            @endforeach
            @if($Status == '0')
            <td><?php echo $Tanggal?></td>
            <td><?php echo $NoBatch;?></td>
            <td><?php echo $Jumlah;?></td>
            <td>
                <a href="{{route('StartPembibitan', [
                    'TanggalSterilisasi'=>$Tanggal, 
                    'NoBatch'=>$NoBatch, 
                    'Jumlah'=>$Jumlah, 
                    'sterilisasi_id'=>$sterilisasi_id,
                ])}}">
                    Mulai Pembibitan
                </a></td>
            @endif
        </tr>
        @endforeach
        @endforeach

    </table>
</section>

@endsection