@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Mylea</li>
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
                <a class="btn btn-primary" href="{{url('/admin/mylea/report/export-data')}}" role="button">Export Data</a>
            </div>
        </div>
        <div class="row">
            <form action="{{url('/admin/mylea/report')}}" method="GET">
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
                <th>Jumlah</th>
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

            @foreach ($MyleaProduction as $data )
                <tr>
                    <td>{{$data['KodeProduksi']}}</td>
                    <td>{{$data['TanggalProduksi']}}</td>
                    <td>{{$data['JumlahBaglog']}}</td>
                    <td>{{$data['JumlahKontaminasi']}}</td>
                    <td>{{$data['JumlahBaglog'] - $data['JumlahKontaminasi']}} tes instock</td>
                    <td>{{$data['Passed'] + $data['Reject']}}</td>
                    <td>{{$data['JumlahBaglog'] - ($data['JumlahKontaminasi'] + $data['Passed'] + $data['Reject'])}}</td>
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
                            Elus 1  : {{$data['Reminder'][0]['Elus1']}} <br>
                            Elus 2  : {{$data['Reminder'][0]['Elus2']}} <br>
                            Elus 3  : {{$data['Reminder'][0]['Elus3']}} <br>
                            Panen  : {{$data['Reminder'][0]['TanggalPanen']}} <br>
                        </div>
                        </div>
                    </td>
                    <td>
                        {{ $data['id'] }}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DataBaglog{{$data['id']}}" data-bs-dismiss="modal">
                            Data Baglog
                        </button>
                        @include('admin.mylea.ReportPartials.DataBaglog')
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DataHarvest{{$data['id']}}" data-bs-dismiss="modal">
                            Data Harvest
                        </button>
                        @include('admin.mylea.ReportPartials.DataHarvest')
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DataPT{{$data['id']}}" data-bs-dismiss="modal">
                            Data Post Treatment
                        </button>
                        @include('admin.mylea.ReportPartials.DataPostTreatment')
                    </td>
                    <td><a href="{{url('/admin/mylea/report-edit', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Edit</a></td>
                    <td><a href="{{url('/admin/mylea/report/kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Data Kontaminasi</a></td>
                    <td><a href="{{url('/admin/mylea/report/form-kontaminasi', ['KodeProduksi'=>$data['KodeProduksi'],])}}">Form Kontaminasi</a></td>
                </tr>
            @endforeach
        </table>
    </div>
        <div class="d-flex justify-content-center">
            {!! $MyleaProduction->links() !!}
        </div>
</section>
@endsection