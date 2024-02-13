@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Mylea</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <div class="d-flex justify-content-center m-3">
        <h3>Input Produksi Mylea {{$KodeProduksi}}</h3>
    </div>
    <form method="POST" action="{{url('/admin/mylea/report-submit', ['KodeProduksi'=>$KodeProduksi,])}}">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalProduksi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Produksi :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalProduksi" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $MyleaProduction[0]['TanggalProduksi']?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jenis Baglog :</label>
            <div class="col-sm-5">
                <select name="JenisBaglog" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="<?php echo $MyleaProduction[0]['JenisBaglog'];?>"><?php echo $MyleaProduction[0]['JenisBaglog'];?></option>
                    <option value="Tempe">Tempe</option>
                    <option value="AsaAgro">Asa Agro</option>
                </select>
            </div>
        </div>  
        <div class="row mb-3 ">
            <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahBaglog" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $MyleaProduction[0]['JumlahBaglog'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi :</label>
            <div class="col-sm-5">
                <input type="text" name="Lokasi" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $MyleaProduction[0]['Lokasi'];?>">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection