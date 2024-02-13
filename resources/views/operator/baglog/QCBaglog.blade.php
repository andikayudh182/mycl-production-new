@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">QC Baglog</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Data Kartu Kendali</h3>
    <table class="table m-3 table-responsive ">
        <tr>
            <th>Kode Produksi</th>
            <th>Tanggal Pembibitan</th>
            <th>Tanggal Crushing</th>
            <th>Tanggal Harvest</th>
            <th>Jumlah Baglog</th>
            <th>In Stock</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($KartuKendali as $data )
        @if ($data['Status']=='0')
        <tr>
            <td><?php echo $data['KodeProduksi'];?></td>
            <td><?php echo $data['TanggalPembibitan'];?></td>
            <td><?php echo $data['TanggalCrushing'];?></td>
            <td><?php echo $data['TanggalHarvest'];?></td>
            <td><?php echo $data['JumlahBaglog'];?></td>
            <td>{{$data['InStock']}}</td>
            <td><a href="{{ route('Kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Kontaminasi</a></td>
            <td><a href="{{ route('DataKontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Data Kontaminasi</a></td>
            <td><a href="{{ url('operator/baglog/submit-kartu-kendali', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Selesai</a></td>
        </tr>  
        @endif
        @endforeach

    </table>
</section>
@endsection