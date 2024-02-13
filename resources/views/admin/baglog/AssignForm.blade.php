@extends('layouts.admin')

@section('content')
<div class="m-5">
    <div class="d-flex justify-content-center m-3">
        <h3>Assign Task</h3>
    </div>
    <form method="POST" action="{{route('SubmitAssign', [$NoRecipe])}}">
        @csrf
        <div class="row mb-3 ">
            <label for="NoRecipe" class="col-sm-2 col-form-label col-form-label-sm">No Recipe :</label>
            <div class="col-sm-5">
                <input type="text" name="NoRecipe" value="{{$NoRecipe}}" class="form-control form-control-sm @error('NoRecipe') is-invalid @enderror">
                @error('NoRecipe')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror   
            </div>
        </div>
        <div class="row mb-3 ">
                <label for="TanggalMixing" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Mixing :</label>
                <div class="col-sm-5">
                    <input type="date" name="TanggalMixing" class="form-control form-control-sm @error('TanggalMixing') is-invalid @enderror" id="colFormLabelSm">
                    @error('TanggalMixing')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror   
                </div>
        </div>
        <div class="row mb-3 ">
                <label for="Status" class="col-sm-2 col-form-label col-form-label-sm">Status :</label>
                <div class="col-sm-5">
                    <select name="Status" class="form-control form-control-sm" id="colFormLabelSm" >
                                <option value="0">Belum Dikerjakan</option>
                                <option value="1">Sudah Dikerjakan</option>
                    </select>
                </div>
        </div>
        <div class="row mb-3 ">
            <label for="BatchSterilisasi" class="col-sm-2 col-form-label col-form-label-sm">Batch Sterilisasi:</label>
            <div class="col-sm-5">
                <input type="number" name="BatchSterilisasi" class="form-control form-control-sm @error('BatchSterilisasi') is-invalid @enderror" id="colFormLabelSm">
                @error('BatchSterilisasi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror   
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="TanggalSterilisasi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Sterilisasi :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalSterilisasi" class="form-control form-control-sm @error('TanggalSterilisasi') is-invalid @enderror" id="colFormLabelSm">
                @error('TanggalSterilisasi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror   
            </div>
    </div>
        <input type="submit" value="Assign" name="assign" class="btn btn-primary float-auto">
    </form>
</div>
@endsection
