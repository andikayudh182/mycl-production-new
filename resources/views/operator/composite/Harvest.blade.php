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
    <form method="POST" action="{{url('/operator/composite/production-report/submit-harvest')}}">
    @csrf
        <div class="row mb-3 ">
            <input type="hidden" name="CompositeID" value="{{ $id }}" class="form-control form-control-sm">
            <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
            <div class="col-sm-5">
                <input type="text" name="KodeProduksi" value="<?php echo $KodeProduksi;?>" class="form-control form-control-sm" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisPanen" class="col-sm-2 col-form-label col-form-label-sm">Jenis Panen :</label>
            <div class="col-sm-5">
                <select name="JenisPanen" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="Konta">Konta</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Passed" class="col-sm-2 col-form-label col-form-label-sm">Passed :</label>
            <div class="col-sm-5">
                <input type="number" name="Passed" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Reject" class="col-sm-2 col-form-label col-form-label-sm">Reject :</label>
            <div class="col-sm-5">
                <input type="number" name="Reject" class="form-control form-control-sm" id="colFormLabelSm">
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