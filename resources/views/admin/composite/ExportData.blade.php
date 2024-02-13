@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite/report')}}">Report Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Export Data</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Settings
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="GET" action="{{url('/admin/composite/report/export-data')}}">
                @csrf
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
                <button type="Submit" name="Submit" class="btn btn-primary m-2" value="1">Create Report</button>
            </form>
        </div>
    </div>
</section>

<section class="m-5 container">
    <div class="m-5" id="resume">
        <div class="resumedetails">
            <div class="row">
                <h2>Resume Composite</h2>
                <h4>Total Produksi Composite : {{$Resume['Produksi']}}</h4>
                <h4>Total Kontaminasi Composite : {{$Resume['Kontaminasi']}}</h4>
                <h4>Success Rate : {{$Resume['SuccessRate']}} %</h4>
            </div>
        </div>
    </div>
    <div class="container m-2">
        <div class="row">
            <div class="col-md-8" style="float: left; display:inline-block;">
                <h3>Composite Production Report</h3>
            </div>
            <div class="col-md-4 " style="float: right;">
                <button class="btn btn-primary" onclick="ExportToExcel('xlsx')">Export as .xlsx</button>
                <button class="btn btn-primary" id="export" onclick="generate()">Export as .docx</button>
            </div>
        </div>
    </div>

    <div id="Export">
        <div class="WordSection1">
            <table class="table" id="tbl_exporttable_to_xls">
                <tr>
                    <th>Kode Produksi</th>
                    <th>Tanggal Produksi</th>
                    <th>Jenis Composite</th>
                    <th>Jumlah Composite</th>
                    <th>Jumlah Baglog</th>
                    <th>Kontaminasi</th>
                    <th>In Stock</th>
                    <th>Panen</th>
                    <th>Sisa</th>
                    <th>Lokasi</th>
                    <th>Contamination Rate</th>
                    <th>Data Baglog</th>
                    <th>Passed</th>
                    <th>Reject</th>
                </tr>
                @if(isset($_GET['Submit']))
                @foreach($data as $Data)
                <tr>
                    <td>{{$Data['KodeProduksi']}}</td>
                    <td>{{$Data['TanggalProduksi']}}</td>
                    <td>{{$Data['Nama']}}</td>
                    <td>{{$Data['JumlahComposite']}}</td>
                    <td>{{$Data['JumlahBaglog']}}</td>
                    <td>{{$Data['JumlahKontaminasi']}}</td>
                    <td>{{$Data['InStock']}}</td>
                    <td>{{$Data['Passed'] + $Data['Reject']}}</td>
                    <td>{{$Data['JumlahBaglog'] - ($Data['JumlahKontaminasi'] + $Data['Passed'] + $Data['Reject'])}}</td>
                    <td>{{$Data['Lokasi']}}</td>
                    <td>{{$Data['ContaminationRate'].'%'}}</td>
                    <td>{{$Data['BaglogDetails']}}</td>
                    <td>{{$Data['Passed']}}</td>
                    <td>{{$Data['Reject']}}</td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>
</section>
<div id="break"></br></div>
<div id="header" style="display:none;">
    <center>
        <img src="https://drive.google.com/uc?export=view&id=1a_NtUSJ2nfqUYIMOTucalGRGd2ckyU2U">
        <h2>Composite Production Report</h2>
    </center>
    <div class="row">
        <div class="col-md-4" style="float: right;">
            Tanggal : @if(isset($_GET['Submit']))<?php echo $_GET['TanggalAwal'].' s/d '.$_GET['TanggalAkhir'];?>@endif
        </div>
    </div>    
</div>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/docx@7.7.0/build/index.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>

@if(isset($_GET['Submit']))
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('tbl_exporttable_to_xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('ReportComposite<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
        }
</script>
@include('admin.composite.ExportDataJS')
@endif
@endsection
