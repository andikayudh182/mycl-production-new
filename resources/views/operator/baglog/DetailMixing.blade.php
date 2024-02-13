@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/produksi-baglog-1') }}">Tahap Produksi Baglog 1</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Mixing</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <div class="d-flex justify-content-center m-3">
        <h3>Detail Baglog Making</h3>
    </div>
    @foreach ($Detail as $Detail )
    <div class="row mb-3 ">
        <label class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
        <div class="col-sm-5">
            <input type="text" value="<?php echo $Detail['NoRecipe']; ?>" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>
    <div class="row mb-3 ">
        <label for="JenisBibit" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bibit :</label>
        <div class="col-sm-5">
            <input type="text" name="JenisBibit"  id="colFormLabelSm" value="{{$Detail['JenisBibit']}}" disabled readonly>
            @error('JenisBibit')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3 ">
        <label class="col-sm-2 col-form-label col-form-label-sm">Total Bags :</label>
        <div class="col-sm-5">
            <input type="number" step="any" value="<?php echo $Detail['TotalBags']; ?>" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>
    <div class="row mb-3 ">
        <label class="col-sm-2 col-form-label col-form-label-sm">Jenis Autoclave :</label>
        <div class="col-sm-5">
            <input type="number" step="any" value="<?php echo $Detail['JenisAutoclave']; ?>" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>
    <div class="row mb-3 ">
        <label class="col-sm-2 col-form-label col-form-label-sm">Weight per Bag:</label>
        <div class="col-sm-5">
            <input type="number" step="any" value="<?php echo $Detail['WeightperBag']; ?>" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>
    @endforeach

    <h3>Bahan Mixing</h3>
    <table class="table">
        <tr>
            <th>Bahan</th>
            <th>No Kontainer</th>
            <th>Jumlah</th>
        </tr>
        @foreach ($Bahan as $Bahan )
        <tr>
            <td>Serbuk Kayu</td>
            <td>{{$Bahan['NoKontSKayu']}}</td>
            <td><?php echo number_format($Bahan['SKayu'], 3);?></td>
        </tr>
        <tr>
            <td>CaCO3</td>
            <td>{{$Bahan['NoKontCaCO3']}}</td>
            <td><?php echo $Bahan['CaCO3'];?></td>
        </tr>
        <tr>
            <td>Pollard</td>
            <td>{{$Bahan['NoKontPollard']}}</td>
            <td><?php echo $Bahan['Pollard'];?></td>
        </tr>
        <tr>
            <td>Tapioka</td>
            <td>{{$Bahan['NoKontTapioka']}}</td>
            <td><?php echo $Bahan['Tapioka'];?></td>
        </tr>
        <tr>
            <td>Air</td>
            <td></td>
            <td><?php echo $Bahan['Air'];?></td>
        </tr>         
        @endforeach

    </table>   
</section>
@endsection