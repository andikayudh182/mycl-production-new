@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <form method="POST" action="{{url('/admin/composite/report/kontaminasi-submit', ['id'=>$id,])}}">
            @csrf
            @foreach ($CompositeKonta as $data)
            <div class="row mb-3 ">
                <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
                <div class="col-sm-5">
                    <input type="text" name="KodeProduksi" value="<?php echo $data['KodeProduksi'];?>" class="form-control form-control-sm" readonly>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Kontaminasi :</label>
                <div class="col-sm-5">
                    <input type="number" name="Jumlah" class="form-control form-control-sm" id="colFormLabelSm"  value="<?php echo $data['Jumlah'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TanggalKonta" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalKonta" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalKonta'];?>">
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                <div class="col-sm-5">
                    <input type="text" name="Keterangan" class="form-control form-control-sm" id="colFormLabelSm"  value="<?php echo $data['Keterangan'];?>">
                </div>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto"> 
            @endforeach
        </form>
    </section>
@endsection