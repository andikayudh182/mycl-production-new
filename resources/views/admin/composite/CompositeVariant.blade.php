@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Composite Variant</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Form Variant Composite
        </a>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="POST" id="FormInputData" action="{{url('/admin/composite/composite-variant-submit')}}">
                @csrf
                <input name="id" id="id" type="hidden" value="0">
                <div class="row mb-3 ">
                    <label for="Nama" class="col-sm-2 col-form-label col-form-label-sm">Nama :</label>
                    <div class="col-sm-5">
                        <input type="text" id="Nama" name="Nama" id="Nama" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
                    <div class="col-sm-5">
                        <input type="text" id="Keterangan" name="Keterangan" id="Keterangan" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="InkubasiSatu" class="col-sm-2 col-form-label col-form-label-sm" >Lama Inkubasi 1 :</label>
                    <div class="col-sm-5">
                        <input type="number" id="InkubasiSatu" name="InkubasiSatu" id="InkubasiSatu" value="0" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="InkubasiDua" class="col-sm-2 col-form-label col-form-label-sm">Lama Inkubasi 2  :</label>
                    <div class="col-sm-5">
                        <input type="number" id="InkubasiDua" name="InkubasiDua" id="InkubasiDua" value="0" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-3 ">
                    <label for="InkubasiTiga" class="col-sm-2 col-form-label col-form-label-sm">Lama Inkubasi 3  :</label>
                    <div class="col-sm-5">
                        <input type="number" id="InkubasiTiga" name="InkubasiTiga" id="InkubasiTiga" value="0" class="form-control form-control-sm">
                    </div>
                </div>
                <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
                <a href="" class="btn btn-danger" onclick="Reset()">Reset</a> 
            </form>
        </div>
      </div>
</section>

@include("admin.composite.ReportPartials.EditVariantPartials")

<section class="m-5">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table">
        <tr>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Lama Inkubasi 1</th>
            <th>Lama Inkubasi 2</th>
            <th>Lama Inkubasi 3</th>
            <th colspan ="2" class ="text-center">Aksi</th>
        </tr>
        @foreach ($Data as $item)
        <tr>
            <td>{{$item['Nama']}}</td>
            <td>{{$item['Keterangan']}}</td>
            <td>{{$item['InkubasiSatu']}}</td>
            <td>{{$item['InkubasiDua']}}</td>
            <td>{{$item['InkubasiTiga']}}</td>
            <td> 
                <a data-bs-toggle="modal" data-bs-target="#modalExample" onclick="Update({{$item}})" class="btn btn-warning">
                    <i class="bi bi-pencil-fill"></i>
                </a>
            </td>
            <td><a href="{{url('/admin/composite/composite-variant-delete', ['id'=> $item['id']])}}" class="btn btn-danger"><i class="bi bi-trash3"></i></a></td>
        </tr> 
        @endforeach
    </table>

    <script>
        function Update(item) {
            var ModalName = "#modalExample";
            console.log(item);
            document.getElementById("idEdit").value = item.id;
            document.getElementById("NamaEdit").value = item.Nama;
            document.getElementById("KeteranganEdit").value = item.Keterangan;
            document.getElementById("InkubasiSatuEdit").value = item.InkubasiSatu;
            document.getElementById("InkubasiDuaEdit").value = item.InkubasiDua;
            document.getElementById("InkubasiTigaEdit").value = item.InkubasiTiga;
            document.getElementById("exampleModalLabel").innerText = "Edit Data Composite " + item.Nama;
        }

        function Reset() {
            document.getElementById("id").value = "0";
            document.getElementById("Nama").value = "";
            document.getElementById("Keterangan").value = "";
            document.getElementById("InkubasiSatu").value = "";
            document.getElementById("InkubasiDua").value = "";;
            document.getElementById("InkubasiTiga").value = "";
        }

        function ResetEdit() {
            document.getElementById("idEdit").value = "0";
            document.getElementById("NamaEdit").value = "";
            document.getElementById("KeteranganEdit").value = "";
            document.getElementById("InkubasiSatuEdit").value = "";
            document.getElementById("InkubasiDuaEdit").value = "";
            document.getElementById("InkubasiTigaEdit").value = "";
        }
    </script>

</section>

@endsection

{{-- <p>{{ $Data }}</p> --}}