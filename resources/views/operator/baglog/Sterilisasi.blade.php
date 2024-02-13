@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sterilisasi</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <form action="{{ url('operator/baglog/submit-sterilisasi') }}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
            <div class="col-sm-5">
            <select name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisAutoclave" class="col-sm-2 col-form-label col-form-label-sm">Jenis Autoclave :</label>
            <div class="col-sm-5">
                <select name="JenisAutoclave" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="NoRecipe" class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
            <div class="col-sm-5">
                <input list="NoRecipe" name="NoRecipe" class="form-control form-control-sm" id="colFormLabelSm">
                <datalist>
                    @foreach ($NoRecipe as $data )
                        <option value="<?php echo $data['NoRecipe']?>"><?php echo $data['NoRecipe']?></option>
                    @endforeach    
                </datalist>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
            <div class="col-sm-5">
                <input type="number" name="Jumlah" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
</section>
@endsection