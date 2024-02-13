@extends('layouts.admin')

@section('content')

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

       {{-- Alert Message --}}
       @if (session()->has('success'))
       <div class="d-flex justify-content-center align-items-center">
           <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
               {{ session()->get('success') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       </div>
       @elseif(session()->has('error'))          
       <div class="d-flex justify-content-center align-items-center">
           <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
               {{ session()->get('error') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
       </div>
       @endif
       {{-- End Alert --}}
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Composite</li>
        </ol>
    </nav>
</div>

<section class="m-5 container">
    <div class="container">
        <div class="row">
            <div class="col-md-10" style="float: left; display:inline-block;">
                <h3>Production Report</h3>
            </div>
            <div class="col-md-2 " style="float: right;">
                {{-- ini belum --}}
                <a class="btn btn-primary" href="{{url('/admin/composite/report/export-data')}}" role="button">Export Data</a>
            </div>
        </div>
        <div class="row">
            <form action="{{url('/admin/composite/report')}}" method="GET">
                <p>
                  <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Filter
                  </a>
                </p>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <div class="row mb-3 ">
                      <label for="TanggalAwal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Awal :</label>
                      <div class="col-sm-5">
                          <input type="date" name="TanggalAwal" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAwal') }}">
                      </div>
                  </div>
                  <div class="row mb-3 ">
                      <label for="TanggalAkhir" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Akhir :</label>
                      <div class="col-sm-5">
                          <input type="date" name="TanggalAkhir" class="form-control form-control-sm " id="colFormLabelSm" value="{{ old('TanggalAkhir') }}">
                      </div>
                  </div>
                  <button type="Submit" name="Filter" class="btn btn-primary m-2" value="1">Filter Data</button>
                  </div>
                </div>
              
                <div class="input-group mb-3" style="width:250px">
                  <input type="text" name="SearchQuery" placeholder="Search..." value="{{ old('SearchQuery') }}" class="form-control">
                  <div class="input-group-append">
                    <input name="Submit" type="submit" value="Search" class="btn btn-outline-primary">
                  </div>
                </div>
                </form>
        </div>
        <div class="row">
            <div class="col-md-10" style="float: left; display:inline-block;">
                <h3>In Stock : {{$TotalInStock}}</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
                <th>@sortablelink('TanggalProduksi','Tanggal Produksi')</th>
                <th>Jenis Composite</th>
                <th>Jumlah Composite</th>
                <th>Jumlah Baglog</th>
                <th>Kontaminasi</th>
                <th>In Stock</th>
                <th>Panen</th>
                <th>Sisa</th>
                <th>Lokasi</th>
                <th>Contamination Rate</th>
                <th>Passed</th>
                <th>Reject</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($CompositeProduction as $data )
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['Nama']}}</td>
                    <td>{{$data['JumlahComposite']}}</td>
                    <td>{{$data['JumlahBaglog']}}</td>
                    <td>{{$data['JumlahKontaminasi']}}</td>
                    <td>{{$data['JumlahComposite'] - $data['JumlahKontaminasi']}}</td>
                    <td>{{$data['Passed'] + $data['Reject']}}</td>
                    <td>{{$data['JumlahComposite'] - ($data['JumlahKontaminasi'] + $data['Passed'] + $data['Reject'])}}</td>
                    <td>{{$data['Lokasi']}}</td>
                    <td>{{number_format($data['JumlahKontaminasi']/$data['JumlahBaglog']*100, 2)}}%</td>
                    <td>{{$data['Passed']}}</td>
                    <td>{{$data['Reject']}}</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-controls="offcanvasRight">Jadwal</button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Jadwal Produksi <?php echo $data['KodeProduksi'];?></h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            Buka Cetakan : {{$data['Reminder'][0]['TanggalBukaCetakan']}} <br>
                            Inkubasi : {{$data['Reminder'][0]['TanggalInkubasi']}} <br>
                            Panen : {{$data['Reminder'][0]['TanggalPanen']}} <br><br>
                        </div>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DataBaglog{{$data['id']}}" data-bs-dismiss="modal">
                            Data Baglog
                        </button>
                        @include('admin.composite.ReportPartials.DataBaglog')
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DataHarvest{{$data['id']}}" data-bs-dismiss="modal">
                            Data Harvest
                        </button>
                        @include('admin.composite.ReportPartials.DataHarvest')
                    </td>
                    <td><a href="{{url('/admin/composite/report-edit', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Edit</a></td>
                    <td><a href="{{url('/admin/composite/report/kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Data Kontaminasi</a></td>
                    <td><a href="{{url('/admin/composite/report/form-kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Form Kontaminasi</a></td>
                </tr>
            @endforeach
        </table>
    </div>
        <div class="d-flex justify-content-center">
            {!! $CompositeProduction->links() !!}
        </div>

</section>

@endsection