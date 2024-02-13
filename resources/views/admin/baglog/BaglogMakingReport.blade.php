@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Baglog Making Report</li>
        </ol> 
    </nav>
    </div>

    <section class="m-5">
        <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Settings
            </a>
            <button class="btn btn-primary" id="export">Export as .docx</button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form method="GET" action="{{url('/admin/baglog/report/baglog-making-report')}}">
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
                    <h2>Resume Baglog</h2>
                    <h4>Total Produksi Baglog : {{$Resume['TotalBaglog']}}</h4>
                </div>
                <div class="row">
                    <h4>Total Pemakaian Bahan :</h4>
                    <div class="col-3">
                        CaCO3 : {{$Resume['CaCO3']}} kg
                    </div>
                    <div class="col-3">
                        Serbuk Kayu : {{$Resume['SKayu']}} kg
                    </div>
                    <div class="col-3">
                        Pollard : {{$Resume['Pollard']}} kg
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        Tapioka : {{$Resume['Tapioka']}} kg
                    </div>
                    <div class="col-3">
                        Air : {{$Resume['Air']}} kg
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link" id="nav-full-tab" data-bs-toggle="tab" data-bs-target="#nav-full-report" type="button" role="tab" aria-controls="nav-full-report" aria-selected="false">Full Report</button>
              <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order-report" type="button" role="tab" aria-controls="nav-order-report" aria-selected="false">Order Report</button>
              <button class="nav-link" id="nav-actual-tab" data-bs-toggle="tab" data-bs-target="#nav-actual-report" type="button" role="tab" aria-controls="nav-actual-report" aria-selected="false">Actual Report</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-full-report" role="tabpanel" aria-labelledby="nav-home-tab">
                @include('admin.baglog.BMPartialFullReport')
            </div>
            <div class="tab-pane fade" id="nav-order-report" role="tabpanel" aria-labelledby="nav-order-tab">
                @include('admin.baglog.BMPartialOrderReport')
            </div>
            <div class="tab-pane fade" id="nav-actual-report" role="tabpanel" aria-labelledby="nav-actual-tab">
                @include('admin.baglog.BMPartialActualReport')
            </div>
        </div>

        <div id="break"></br></div>
        <div id="header" style="display:none;">
            <center>
                <img src="https://drive.google.com/uc?export=view&id=1a_NtUSJ2nfqUYIMOTucalGRGd2ckyU2U">
                <h2>Baglog Making Report</h2>
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
        @if($_GET['Submit']=='1')
        <script>
            function ExportToExcelFull(type, fn, dl) {
                var elt = document.getElementById('tbl_exporttable_to_xls_full');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                return dl ?
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                    XLSX.writeFile(wb, fn || ('FullBaglogMakingReport_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
                }
            function ExportToExcelOrder(type, fn, dl) {
                var elt = document.getElementById('tbl_exporttable_to_xls_order');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                return dl ?
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                    XLSX.writeFile(wb, fn || ('OrderBaglogMakingReport_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
                }
            function ExportToExcelActual(type, fn, dl) {
                var elt = document.getElementById('tbl_exporttable_to_xls_actual');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                return dl ?
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                    XLSX.writeFile(wb, fn || ('ActualBaglogMakingReport_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
                }
        </script>
        @include('admin.baglog.ExportDataJS.BMReportExportJS')
        @endif
        @endif
    </section>

@endsection