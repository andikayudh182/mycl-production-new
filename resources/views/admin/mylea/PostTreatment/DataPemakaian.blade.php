@extends('layouts.admin')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment/stock-card') }}">Stock Card</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pemakaian</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($Details as $Detail)
        <div class="row mb-3 ">
            <label for="Warna" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="{{$Detail['KodeProduksi']}}" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Warna" class="col-sm-2 col-form-label col-form-label-sm">Warna :</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="{{$Detail['Warna']}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="Grade" class="col-sm-2 col-form-label col-form-label-sm">Grade :</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="{{$Detail['Grade']}}" readonly>     
            </div>
        </div>
        <div class="row mb-3">
            <label for="Ukuran" class="col-sm-2 col-form-label col-form-label-sm">Ukuran :</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="{{$Detail['Ukuran']}}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <label for="KategoriReinforce" class=" col-sm-2 col-form-label col-form-label-sm">Kategori Reinforce :</label>
            <div class="col-sm-2">
                <input class="form-control" type="text" placeholder="{{$Detail['KategoriReinforce']}}" readonly>
            </div>
        </div>
    @endforeach

<table class="table">
    <tr>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Notes</th>
    </tr>
    @foreach ($Pemakaian as $item)
        <tr>
            <td>{{$item['Tanggal']}}</td>
            <td>{{$item['Jumlah']}}</td>
            <td>{{$item['Notes']}}</td>
            <td><a href="{{route('DeletePemakaian', ['id'=>$item['id'],])}}">Delete</a></td>
        </tr>   
    @endforeach

</section>

@endsection