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
    <h3>Order Produksi</h3>
        <table class="table">
            <tr>
                <th>Kode Produksi</th>
                <th>Tanggal Produksi</th>
                <th>Jumlah</th>
                <th>Lokasi</th>
            </tr>
            @foreach ($MyleaProduction as $data)
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['JumlahBaglog']}}</td>
                    <td>{{$data['Lokasi']}}</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-controls="offcanvasRight">Data Baglog</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Data Baglog Mylea <?php echo $data['KodeProduksi'];?></h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                @if(isset($Baglog[$data['KodeProduksi']]))
                                @foreach ($Baglog[$data['KodeProduksi']] as $baglog )
                                    <?php echo $baglog['KodeBaglog'];?> : <?php echo $baglog['Jumlah'];?> </br>
                                @endforeach   
                                @endif 
                            </div>
                        </div>
                    </td>
                    <td><a href="{{ route('UpdateOrderProduksiMylea', ['KodeProduksi'=>$data['KodeProduksi'],]) }}">Kerjakan</a></td>
                </tr>
            @endforeach
        </table>
</section>
@endsection