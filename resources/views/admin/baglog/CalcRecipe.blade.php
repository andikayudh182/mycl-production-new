@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Baglog Recipe Calculator</li>
            </ol>
        </nav>
    </div>

    <div class="m-5">
        <div class="d-flex justify-content-center">
            <h3>Baglog Recipe Calculator</h3>
        </div>
        <div class="d-flex justify-content-center mb-5">
            <h4>STP20 65%</h4>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <form method="POST" action="{{url('/admin/baglog/recipe-submit')}}">
            @csrf
            <div class="row mb-3 ">
                <label for="NoRecipe" class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
                <div class="col-sm-5">
                    <input type="text" name="NoRecipe" class="form-control form-control-sm @error('NoRecipe') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoRecipe') }}" autocomplete="off">
                    @error('NoRecipe')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            {{-- <div class="row mb-3 ">
                <label for="JenisBibit" class="col-sm-2 col-form-label col-form-label-sm">Jenis Bibit :</label>
                <div class="col-sm-5">
                    <input type="text" name="JenisBibit" class="form-control form-control-sm @error('JenisBibit') is-invalid @enderror" id="colFormLabelSm" value="{{ old('JenisBibit') }}" autocomplete="off">
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
                        <option value="">Pilih Jenis Baglog</option>
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
                    <input type="date" name="TanggalKeluar" class="form-control form-control-sm  @error('TanggalKeluar') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalKeluar') }}">
                    @error('TanggalKeluar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="TotalBags" class="col-sm-2 col-form-label col-form-label-sm">Total Bags :</label>
                <div class="col-sm-5">
                    <input id="multiselect" type="number" step="any" name="TotalBags" class="form-control form-control-sm  @error('TotalBags') is-invalid @enderror" id="colFormLabelSm" value="{{ old('TanggalKeluar') }}">
                    @error('TotalBags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="JenisAutoclave" class="col-sm-2 col-form-label col-form-label-sm">Jenis Autoclave :</label>
                <div class="col-sm-5">
                    <select name="JenisAutoclave" class="form-control form-control-sm selectpicker" id="colFormLabelSm" value="{{ old('JenisAutoclave') }}" multiple>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    @error('JenisAutoclave')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> 
            </div>
            <div class="row mb-3 ">
                <label for="WeightperBag" class="col-sm-2 col-form-label col-form-label-sm">Weight per bag :</label>
                <div class="col-sm-5">
                    <input type="number" step="any" name="WeightperBag" class="form-control form-control-sm  @error('WeightperBag') is-invalid @enderror" id="colFormLabelSm" value="{{ old('WeightperBag') }}">
                    @error('WeightperBag')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="MCSKayu" class="col-sm-2 col-form-label col-form-label-sm">MC Serbuk Kayu :</label>
                <div class="col-sm-1">
                    <input type="number" step="any" name="MCSKayu" class="form-control form-control-sm @error('MCSKayu') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCSKayu') }}">
                    @error('MCSKayu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <p>%</p>
                </div>
                <label for="NoKontSKayu" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer Serbuk Kayu :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="NoKontSKayu" class="form-control form-control-sm @error('NoKontSKayu') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoKontSKayu') }}">
                    @error('NoKontSKayu')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="SKayu" class="col-sm-2 col-form-label col-form-label-sm">Serbuk Kayu :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="SKayu" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="MCHickory" class="col-sm-2 col-form-label col-form-label-sm">MC Hickory :</label>
                <div class="col-sm-1">
                    <input type="number" step="any" name="MCHickory" class="form-control form-control-sm @error('MCHickory') is-invalid @enderror" id="colFormLabelSm" value="" disabled>
                    @error('MCHickory')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <p>%</p>
                </div>
                <label for="NoKontHickory" class="col-sm-2 col-form-label col-form-label-sm">No Kontainer Hickory :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="NoKontHickory" class="form-control form-control-sm @error('NoKontHickory') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoKontHickory') }}" disabled>
                    @error('NoKontHickory')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="Hickory" class="col-sm-2 col-form-label col-form-label-sm">Hickory :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="Hickory" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                </div>
            </div>
            <h4>Bahan</h4>
            <div class="row mb-3 ">
                <label for="MCCaCO3" class="col-sm-1 col-form-label col-form-label-sm">MC CaCO3 :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="MCCaCO3" class="form-control form-control-sm @error('MCCaCO3') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCCaCO3') }}">
                    @error('MCCaCO3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-1">
                    <p>%</p>
                </div>
                <label for="NoKontCaCO3" class="col-sm-1 col-form-label col-form-label-sm">No Karung CaCO3 :</label>
                <div class="col-sm-2">
                    <input type="text" step="any" name="NoKontCaCO3" class="form-control form-control-sm @error('NoKontCaCO3') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoKontCaCO3') }}">
                    @error('NoKontCaCO3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="CaCO3" class="col-sm-2 col-form-label col-form-label-sm">CaCO3 :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="CaCO3" class="form-control form-control-sm" id="colFormLabelSm" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="MCPollard" class="col-sm-1 col-form-label col-form-label-sm">MC Pollard :</label>
                <div class="col-sm-2">
                    <input type="text" step="any" name="MCPollard" class="form-control form-control-sm @error('MCPollard') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCPollard') }}">
                    @error('MCPollard')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror            
                </div>
                <div class="col-sm-1">
                    <p>%</p>
                </div>
                <label for="NoKontPollard" class="col-sm-1 col-form-label col-form-label-sm">No Karung Pollard :</label>
                <div class="col-sm-2">
                    <input type="text" step="any" name="NoKontPollard" class="form-control form-control-sm @error('NoKontPollard') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoKontPollard') }}">
                    @error('NoKontPollard')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="Pollard" class="col-sm-2 col-form-label col-form-label-sm">Pollard :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="Pollard" class="form-control form-control-sm " id="colFormLabelSm" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="MCTapioka" class="col-sm-1 col-form-label col-form-label-sm">MC Tapioka :</label>
                <div class="col-sm-2">
                    <input type="number" step="any" name="MCTapioka" class="form-control form-control-sm @error('MCTapioka') is-invalid @enderror" id="colFormLabelSm" value="{{ old('MCTapioka') }}">
                    @error('MCTapioka')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror            
                </div>
                <div class="col-sm-1">
                    <p>%</p>
                </div>
                <label for="NoKontTapioka" class="col-sm-1 col-form-label col-form-label-sm">No Karung Tapioka :</label>
                <div class="col-sm-2">
                    <input type="text" step="any" name="NoKontTapioka" class="form-control form-control-sm @error('NoKontTapioka') is-invalid @enderror" id="colFormLabelSm" value="{{ old('NoKontTapioka') }}">
                    @error('NoKontTapioka')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="Tapioka" class="col-sm-2 col-form-label col-form-label-sm">Tapioka :</label>
                <div class="col-sm-3">
                    <input type="number" step="any" name="Tapioka" id="Tapioka" class="form-control form-control-sm"  disabled>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Air" class="col-sm-2 col-form-label col-form-label-sm">Air :</label>
                <div class="col-sm-4">
                    <input type="number" step="any" name="Air" class="form-control form-control-sm @error('Air') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Air') }}" disabled>
                </div>
            </div>
            <input type="button" id="Calculate" name="Calculate" value="Calculate" class="btn btn-primary float-auto">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </div>

    <script>
        const btn = document.querySelector('.selectpicker');
        btn.onchange = (event) => {
            event.preventDefault();
            // show the selected index
            var selected = $('.selectpicker').val();;
            let TotalBags = '0';
            for (i = 0; i < selected.length; i++) {
                if(selected[i] == 1 || selected[i] == 2){
                    TotalBags = Number(TotalBags) + 17;
                } else if(selected[i] == 3){
                    TotalBags = Number(TotalBags) + 7;
                }
                
                console.log($('.selectpicker').val());
            } 
            document.querySelector('input[name="TotalBags"]').value = TotalBags;
        };
    </script>
    <script>
        const selectElement = document.getElementById('colFormLabelSmJenisBaglog');
    
        selectElement.addEventListener('change', function() {
            const optionPilihJenisBaglog = selectElement.querySelector('option[value=""]');
            optionPilihJenisBaglog.disabled = true;
        });
    </script>
    <script language="javascript" type="text/javascript">
        SKayu = document.querySelector('input[name="MCSKayu"]');
        Hickory = document.querySelector('input[name="MCHickory"]');
        CaCO3 = document.querySelector('input[name="MCCaCO3"]');
        Pollard = document.querySelector('input[name="MCPollard"]');
        Tapioka = document.querySelector('input[name="MCTapioka"]');
        WeightperBag = document.querySelector('input[name="WeightperBag"]');
        TotalBags = document.querySelector('input[name="TotalBags"]');
        Calculate = document.getElementById("Calculate");

        Calculate.addEventListener('click', function(){
            W = WeightperBag.value;
            T = TotalBags.value;
            //0.37 = dry substrate
            x = 0.40 * W;
            WCaCO3 = x * 0.03 * 0.1 / (100 - CaCO3.value);
            WSKayu = x * 0.67 * 0.1 / (100 - SKayu.value);
            WPollard = x * 0.20 * 0.1 / (100 - Pollard.value);
            WTapioka = x * 0.10 * 0.1 / (100 - Tapioka.value);
            TotalW =  WCaCO3 + WSKayu + WPollard + WTapioka;
            TotalD = (x * 0.03 + x * 0.67 + x * 0.20 + x * 0.10)/1000;
            //0.63 = water content
            WAir = (0.60 * W/1000) - (TotalW - x/1000);
            document.querySelector('input[name="Tapioka"]').value = (Math.round(WTapioka * T / 0.005)*0.005).toFixed(3);
            document.querySelector('input[name="Pollard"]').value = (Math.round(WPollard * T / 0.005)*0.005).toFixed(3);
            document.querySelector('input[name="CaCO3"]').value = (Math.round(WCaCO3 * T / 0.005)*0.005).toFixed(3);
            document.querySelector('input[name="SKayu"]').value = (Math.round(WSKayu * T / 0.005)*0.005).toFixed(3);
            document.querySelector('input[name="Air"]').value = (Math.round(WAir * T / 0.005)*0.005).toFixed(3);
        });

    </script>
@endsection

