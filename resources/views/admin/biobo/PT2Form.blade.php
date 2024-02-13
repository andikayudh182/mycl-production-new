@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo/PT2')}}">Post Treatment 2</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post Treatment 2 Form</li>
            </ol>
        </nav>
    </section>

    <section class="m-5">
        @foreach($Data as $data)
        <form method="POST" action="{{url('/admin/biobo/pt2-submit', ['id'=>$data['id'],])}}">
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
                <label for="TanggalSanding" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sanding :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalSanding" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalSanding']?>">
                </div>
            </div>            <div class="row mb-3 ">
                <label for="TanggalCutting" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Cutting :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalCutting" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalCutting']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 10x15 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U10x15']?>">
                </div>
                <div class="col-sm-2">
                    Sanding :
                    <input type="number" name="PSanding10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PSanding10x15']?>">
                </div>
                <div class="col-sm-2">
                    Cutting :
                    <input type="number" name="PCutting10x15" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PCutting10x15']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 10x20 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U10x20']?>">
                </div>
                <div class="col-sm-2">
                    Sanding :
                    <input type="number" name="PSanding10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PSanding10x20']?>">
                </div>
                <div class="col-sm-2">
                    Cutting :
                    <input type="number" name="PCutting10x20" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PCutting10x20']?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <h4>Ukuran 30x30 :</h4>
                <div class="col-sm-2">
                    Jumlah Awal :
                    <input type="number" name="U30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['U30x30']?>">
                </div>
                <div class="col-sm-2">
                    Sanding :
                    <input type="number" name="PSanding30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PSanding30x30']?>">
                </div>
                <div class="col-sm-2">
                    Cutting :
                    <input type="number" name="PCutting30x30" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['PCutting30x30']?>">
                </div>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
        @endforeach
    </section>
@endsection
