@extends('layouts.admin')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment/stock-card') }}">Stock Card</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Pemakaian</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <form method="POST" action="{{url('/admin/mylea/post-treatment/stock-card/form-pemakaian-submit')}}">
        @csrf
        <input type="hidden" name="id_details" value="{{$id}}">
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
            <div class="col-sm-5">
                <input type="date" name="Tanggal" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3">
            <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
            <div class="col-sm-5">
                <input type="number" name="Jumlah" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Notes" class="col-sm-2 col-form-label col-form-label-sm">Notes :</label>
            <div class="col-sm-5">
                <input type="text" name="Notes" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto" id="submit">
    </form>
</section>
@endsection