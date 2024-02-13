@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report-sterilisasi')}}">Data Mixing</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Mixing</li>
        </ol> 
    </nav>
    </div>

    <section class="m-5 container">
        <h3>Edit Sterilisasi</h3>
        <form method="POST" class="m-5" action="{{ url('admin/baglog/report-sterilisasi/submit')}}">
            @csrf
            @foreach ($Data as $data)
            <div class="row mb-3 ">
                <label for="id" class="col-sm-2 col-form-label col-form-label-sm">No :</label>
                <div class="col-sm-5">
                    <input type="text" name="id" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['id'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TanggalSterilisasi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sterilisasi :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalSterilisasi" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalSterilisasi'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
                <div class="col-sm-5">
                    <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['NoBatch'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JenisAutoclave" class="col-sm-2 col-form-label col-form-label-sm">Jenis Autoclave :</label>
                <div class="col-sm-5">
                    <input type="text" name="JenisAutoclave" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['JenisAutoclave'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="NoRecipe" class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
                <div class="col-sm-5">
                    <input type="text" name="NoRecipe" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['NoRecipe'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
                <div class="col-sm-5">
                    <input type="number" name="Jumlah" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['Jumlah'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                <div class="col-sm-5">
                    <input type="text" name="Keterangan" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['Keterangan'];?>">
                </div>
            </div>
            <input type="submit" value="submit" name="submit" class="btn btn-primary float-auto">
            @endforeach
        </form>
    </section>

@endsection