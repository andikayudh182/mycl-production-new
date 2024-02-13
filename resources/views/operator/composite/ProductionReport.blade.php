@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/composite') }}">Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Composite</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <h3>Production Report</h3>
        <table class="table">
            <tr>
                <th>Kode Produksi</th>
                <th>Tanggal Produksi</th>
                <th>Jenis Composite</th>
                <th>Jumlah Composite</th>
                <th>Jumlah Baglog</th>
                <th>Kontaminasi</th>
                <th>In Stock</th>
                <th>Lokasi</th>
            </tr>
            @foreach ($CompositeProduction as $data)
                @php
                $JumlahKonta = 0;
                if (isset($CompositeKonta[$data['KodeProduksi']])){
                    foreach ($CompositeKonta[$data['KodeProduksi']] as $KontaComposite){
                        $JumlahKonta += $KontaComposite['Jumlah'];
                    }
                }
                $JumlahInStock = $data['JumlahComposite'] - $JumlahKonta;
                @endphp
        
                @if ($JumlahInStock > 0)
                    <tr>
                        <td>{{$data['KodeProduksi']}}</td>
                        <td>{{$data['TanggalProduksi']}}</td>
                        <td>{{$data['Nama']}}</td>
                        <td>{{$data['JumlahComposite']}}</td>
                        <td>{{$data['JumlahBaglog']}}</td>
                        <td>
                            {{$JumlahKonta}}
                        </td>
                        <td>{{$JumlahInStock}}</td>
                        <td>{{$data['Lokasi']}}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-controls="offcanvasRight">Jadwal</button>
        
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasRightLabel">Jadwal Produksi <?php echo $data['KodeProduksi'];?></h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    Buka Cetakan  : {{$CompositeReminder[$data['KodeProduksi']][0]['TanggalBukaCetakan']}} <br>
                                    Inkubasi  : {{$CompositeReminder[$data['KodeProduksi']][0]['TanggalInkubasi']}} <br>
                                    Panen  : {{$CompositeReminder[$data['KodeProduksi']][0]['TanggalPanen']}} <br>
                                </div>
                            </div>
                        </td>
                        <td><a href="{{ route('CompositeKontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Kontaminasi</a></td>
                        <td><a href="{{ route('CompositeDataKontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Data Kontaminasi</a></td>
                        <td><a href="{{ route('CompositeHarvest', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Harvest</a></td>
                    </tr> 
                @endif
            @endforeach
        </table>
        
</section>
@endsection