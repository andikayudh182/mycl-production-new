@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/datarecipe')}}">Data Recipe</a></li>
            <li class="breadcrumb-item active" aria-current="page">Recipe</li>
        </ol> 
    </nav>
    </div>
    <section class="m-5">
        <div class="d-flex justify-content-center m-3">
            <h3>Recipe</h3>
        </div>
        @foreach ($Details as $data)
        <form method="POST" action="{{route('SubmitUpdateRecipe', ['NoRecipe'=>$data->NoRecipe])}}">
            @csrf
        <input type="hidden" name="idDetails" value="{{$data['id']}}">
        <div class="row mb-3 ">
            <label for="NoRecipe" class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
            <div class="col-sm-5">
                <input type="text" name="NoRecipe" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['NoRecipe'];?>">
            </div>
        </div>
        {{-- <div class="row mb-3 ">
            <label for="JenisBibit" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bibit :</label>
            <div class="col-sm-5">
                <input type="text" name="JenisBibit" class="form-control form-control-sm @error('JenisBibit') is-invalid @enderror" id="colFormLabelSm" value="{{$data['JenisBibit']}}" autocomplete="off">
                @error('JenisBibit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> --}}
        <div class="row mb-3 ">
            <label for="JenisBibit" class="col-sm-2 col-form-label col-form-label-sm">Jenis Baglog :</label>
            <div class="col-sm-5">
              
                <select name="JenisBibit" class="form-control form-control-sm @error('JenisBibit') is-invalid @enderror" id="colFormLabelSmJenisBaglog">
                    @if($data['JenisBibit'] == 'GN' )
                    <option value="GN">GN</option>
                    @elseif($data['JenisBibit'] == 'TP')
                    <option value="TP">Tempe</option>
                    @else
                    <option value="">Pilih Jenis Baglog</option>
                    @endif
                    <option value="GN">GN</option>
                    <option value="TP">Tempe</option>
                </select>
                @error('JenisBibit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalKeluar" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Keluar Resep :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalKeluar" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TanggalKeluar'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TotalBags" class="col-sm-2 col-form-label col-form-label-sm">Total Bags :</label>
            <div class="col-sm-5">
                <input type="number" step="any" name="TotalBags" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['TotalBags'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisAutoclave" class="col-sm-2 col-form-label col-form-label-sm">Jenis Autoclave :</label>
            <div class="col-sm-5">
                <select name="JenisAutoclave" class="form-control form-control-sm" id="colFormLabelSm" >
                    <option value="<?php echo $data['JenisAutoclave'];?>"><?php echo $data['JenisAutoclave'];?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div> 
        </div>
        <div class="row mb-3 ">
            <label for="WeightperBag" class="col-sm-2 col-form-label col-form-label-sm">Weight per bag :</label>
            <div class="col-sm-5">
                <input type="number" step="any" name="WeightperBag" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data['WeightperBag'];?>">
            </div>
        </div>
        @endforeach
        @foreach ($Bahan as $data2)
        <input type="hidden" name="idBahan" value="{{$data2['id']}}">
        <div class="row mb-3 ">
            <label for="MCSKayu" class="col-sm-2 col-form-label col-form-label-sm">MC Serbuk Kayu :</label>
            <div class="col-sm-4">
                <input type="number" step="any" name="MCSKayu" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['MCSKayu'];?>">
            </div>
            <label for="NoKontSKayu" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer Serbuk Kayu :</label>
            <div class="col-sm-4">
                <input type="number" step="any" name="NoKontSKayu" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['NoKontSKayu'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="MCHickory" class="col-sm-2 col-form-label col-form-label-sm">MC Hickory :</label>
            <div class="col-sm-4">
                <input type="number" step="any" name="MCHickory" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['MCHickory'];?>">
            </div>
            <label for="NoKontHickory" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer Hickory :</label>
            <div class="col-sm-4">
                <input type="number" step="any" name="NoKontHickory" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['NoKontHickory'];?>">
            </div>
        </div>
        <h4>Bahan</h4>
        <div class="row mb-3 ">
            <label for="CaCO3" class="col-sm-2 col-form-label col-form-label-sm">CaCO3 :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="CaCO3" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['CaCO3'];?>">
            </div>
            <label for="NoKontCaCO3" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer :</label>
            <div class="col-sm-2">
                <input type="text" step="any" name="NoKontCaCO3" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['NoKontCaCO3'];?>">
            </div>
            <label for="SKayu" class="col-sm-2 col-form-label col-form-label-sm">Serbuk Kayu :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="SKayu" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['SKayu'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Pollard" class="col-sm-2 col-form-label col-form-label-sm">Pollard :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="Pollard" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['Pollard'];?>">
            </div>
            <label for="NoKontPollard" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer :</label>
            <div class="col-sm-2">
                <input type="text" step="any" name="NoKontPollard" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['NoKontPollard'];?>">
            </div>
            <label for="Hickory" class="col-sm-2 col-form-label col-form-label-sm">Hickory :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="Hickory" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['Hickory'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Tapioka" class="col-sm-2 col-form-label col-form-label-sm">Tapioka :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="Tapioka" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['Tapioka'];?>">
            </div>
            <label for="NoKontTapioka" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer :</label>
            <div class="col-sm-2">
                <input type="text" step="any" name="NoKontTapioka" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['NoKontTapioka'];?>">
            </div>
            <label for="Air" class="col-sm-2 col-form-label col-form-label-sm">Air :</label>
            <div class="col-sm-2">
                <input type="number" step="any" name="Air" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $data2['Air'];?>">
            </div>
        </div>
        @endforeach
            <input type="submit" value="submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </section>

    <script>
        const selectElement = document.getElementById('colFormLabelSmJenisBaglog');
    
        selectElement.addEventListener('change', function() {
            const optionPilihJenisBaglog = selectElement.querySelector('option[value=""]');
            optionPilihJenisBaglog.disabled = true;
        });
    </script>
@endsection