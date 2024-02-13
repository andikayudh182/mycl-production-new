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
{{-- {{ $JenisBibit }} --}}
<section class="m-5">
    <form method="POST" action="{{url('operator/baglog/submit-pembibitan')}}">
        @csrf
        <input type="hidden" name="SterilisasiID" value="{{$sterilisasi_id}}">
        <div class="row mb-3 ">
            <label for="TanggalSterilisasi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sterilisasi :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalSterilisasi" class="form-control form-control-sm" id="colFormLabelSm" value="{{$TanggalSterilisasi}}" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
            <div class="col-sm-5">
                <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="{{$NoBatch}}" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahBaglog" class="form-control form-control-sm" id="colFormLabelSm" value="{{$Jumlah}}">
            </div>
        </div> 
        <div class="row mb-3 ">
            <label for="TanggalBibit" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Bibit :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalBibit" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahBibit" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Bibit :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahBibit" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div> 
        <div class="row mb-3 ">
            <label for="KeteranganBibit" class="col-sm-2 col-form-label col-form-label-sm">Keterangan Bibit :</label>
            <div class="col-sm-5">
                <input type="text" name="KeteranganBibit" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalPembibitan" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pembibitan :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalPembibitan" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi :</label>
            <div class="col-sm-5">
                <input type="text" name="Lokasi" class="form-control form-control-sm" id="colFormLabelSm">
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