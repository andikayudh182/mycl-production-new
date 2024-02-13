@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo/PT1')}}">Post Treatment 1</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post Treatment 1 Form</li>
            </ol>
        </nav>
    </section>

    <section class="m-5">
        @foreach($Data as $data)
        <form method="POST" action="{{url('/admin/biobo/pt1-submit', ['id'=>$data['id'],])}}">
            @csrf
            <div class="row mb-3 ">
                <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
                <div class="col-sm-5">
                    <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['NoBatch']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Terima :</label>
                <div class="col-sm-5">
                    <input type="date" name="Tanggal" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['Tanggal']?>" required>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TanggalDrying" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Drying :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalDrying" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalDrying']?>">
                </div>
            </div>            <div class="row mb-3 ">
                <label for="TanggalPressing" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Pressing :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalPressing" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalPressing']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 10x15 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U10x15']?>">
                </div>
                <div class="col-sm-2">
                    Drying :
                    <input type="number" name="PDrying10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PDrying10x15']?>">
                </div>
                <div class="col-sm-2">
                    Pressing :
                    <input type="number" name="PPressing10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PPressing10x15']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 10x20 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U10x20']?>">
                </div>
                <div class="col-sm-2">
                    Drying :
                    <input type="number" name="PDrying10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PDrying10x20']?>">
                </div>
                <div class="col-sm-2">
                    Pressing :
                    <input type="number" name="PPressing10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PPressing10x20']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 30x30 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U30x30']?>">
                </div>
                <div class="col-sm-2">
                    Drying :
                    <input type="number" name="PDrying30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PDrying30x30']?>">
                </div>
                <div class="col-sm-2">
                    Pressing :
                    <input type="number" name="PPressing30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PPressing30x30']?>">
                </div>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
        @endforeach
    </section>
@endsection