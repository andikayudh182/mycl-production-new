@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Mylea</li>
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
                <th>Jumlah</th>
                <th>Kontaminasi</th>
                <th>In Stock</th>
                <th>Lokasi</th>
            </tr>
            @foreach ($MyleaProduction as $data)
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['JumlahBaglog']}}</td>
                    <td>
                        <?php
                        $JumlahKonta = 0;
                        if (!$MyleaKonta){

                        } else {
                            if (isset($MyleaKonta[$data['KodeProduksi']])){
                                foreach ($MyleaKonta[$data['KodeProduksi']] as $KontaMylea){
                                $JumlahKonta = $JumlahKonta + $KontaMylea['Jumlah'];
                                }
                            }
                        }
                        
                        ?>
                        {{$JumlahKonta}}
                    </td>
                    <td>{{$data['JumlahBaglog']-$JumlahKonta}}</td>
                    <td>{{$data['Lokasi']}}</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-controls="offcanvasRight">Jadwal</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Jadwal Produksi <?php echo $data['KodeProduksi'];?></h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            Elus 1  : {{$MyleaReminder[$data['KodeProduksi']][0]['Elus1']}} <br>
                            Elus 2  : {{$MyleaReminder[$data['KodeProduksi']][0]['Elus2']}} <br>
                            Elus 3  : {{$MyleaReminder[$data['KodeProduksi']][0]['Elus3']}} <br>
                            Panen  : {{$MyleaReminder[$data['KodeProduksi']][0]['TanggalPanen']}} <br>
                            Panen Biobo  : {{$MyleaReminder[$data['KodeProduksi']][0]['PanenBiobo']}} <br>
                        </div>
                        </div>
                    </td>
                    <td><a href="{{ route('MyleaKontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Kontaminasi</a></td>
                    <td><a href="{{ route('MyleaDataKontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Data Kontaminasi</a></td>
                    <td><a href="{{ route('MyleaHarvest', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Harvest</a></td>
                    <td><a href="{{ route('MyleaBiobo', ['KodeProduksi'=>$data['id'],]) }}">Harvest Biobo</a></td>
                </tr>
            @endforeach
        </table>
</section>
@endsection