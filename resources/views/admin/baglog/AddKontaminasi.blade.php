@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol> 
    </nav>
</div>

<section class="m-5">
    <form method="POST" action="{{ url('admin/baglog/submit-kontaminasi')}}">
    @csrf
        <div class="row mb-3 ">
            <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
            <div class="col-sm-5">
                <input type="text" name="KodeProduksi" value="<?php echo $KodeProduksi;?>" class="Disabled input example form-control-sm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahKontaminasi" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Kontaminasi :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahKontaminasi" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
            <div class="col-sm-5">
                <input type="date" name="Tanggal" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
            <div class="col-sm-5">
                <input type="text" name="Keterangan" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection