@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo') }}">Biobo</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo/post-treatment-1') }}">Post Treatment 1</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo/monitoring-post-treatment-1') }}">Monitoring</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Update Drying</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h3>Post Treatment 1 Biobo</h3>
    <form method="POST" action="{{url('/operator/biobo/monitoring-post-treatment-1/form-drying-submit', ['id'=>$id, ])}}">
        @csrf
        <div class="row mb-3 ">
            <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
            <div class="col-sm-5">
                <input type="text" name="NoBatch" class="Disabled input example form-control-sm" id="colFormLabelSm" value="<?php echo $NoBatch?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalDrying" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalDrying" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="U10x15" class="col-sm-2 col-form-label col-form-label-sm">Passed Ukuran 10x15 :</label>
            <div class="col-sm-5">
                <input type="number" name="U10x15" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="U10x15" class="col-sm-2 col-form-label col-form-label-sm">Reject Ukuran 10x15 :</label>
            <div class="col-sm-5">
                <input type="number" name="RU10x15" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="U10x20" class="col-sm-2 col-form-label col-form-label-sm">Passed Ukuran 10x20 :</label>
            <div class="col-sm-5">
                <input type="number" name="U10x20" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="U10x20" class="col-sm-2 col-form-label col-form-label-sm">Reject Ukuran 10x20 :</label>
            <div class="col-sm-5">
                <input type="number" name="RU10x20" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="U30x30" class="col-sm-2 col-form-label col-form-label-sm">Passed Ukuran 30x30 :</label>
            <div class="col-sm-5">
                <input type="number" name="U30x30" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="10x15" class="col-sm-2 col-form-label col-form-label-sm">Reject Ukuran 30x30 :</label>
            <div class="col-sm-5">
                <input type="number" name="R10x15" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection