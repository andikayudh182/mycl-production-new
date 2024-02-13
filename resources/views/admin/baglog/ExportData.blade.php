@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
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
                <form method="GET" action="{{url('/admin/baglog/report/export-data')}}">
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
                    <h4>Total Produksi Baglog : {{$Resume['Produksi']}}</h4>
                    <h4>Total Kontaminasi Baglog : {{$Resume['Kontaminasi']}}</h4>
                    <h4>Success Rate : {{$Resume['SuccessRate']}} %</h4>
                </div>
            </div>
        </div>
        <div class="container m-2">
            <div class="row">
                <div class="col-md-8" style="float: left; display:inline-block;">
                    <h3>Baglog Production Report</h3>
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
                    <th>Jenis Baglog</th>
                    <th>Tanggal Pembibitan</th>
                    <th>Jumlah Baglog</th>
                    <th>Jumlah Kontaminasi</th>
                    <th>Tanggal Kontaminasi</th>
                    <th>Contamination Rate</th>
                    <th>Harvested Baglog</th>
                    <th>In Stock</th>
                    <th>Tanggal Bibit</th>
                    <th>Jumlah Bibit</th>
                    <th>Keterangan Bibit</th>
                </tr>
                @if(isset($data))
                @foreach($data as $Data)
                <tr>
                    <td>{{$Data['KodeProduksi']}}</td>
                    <td>
                        @if($Data['JenisBibit']=='TP')
                            Tempe
                        @else
                            {{ $Data['JenisBibit'] }}
                        @endif
                    </td>
                    <td>{{$Data['TanggalPembibitan']}}</td>
                    <td>{{$Data['JumlahBaglog']}}</td>
                    <td>{{$Data['Kontaminasi']}}</td>
                    <td>{{$Data['TanggalKontaminasi']}}</td>
                    <td>{{$Data['ContaminationRate'].'%'}}</td>
                    <td>{{$Data['InStock']}}</td>
                    <td>
                        @if($Data['JenisBibit'] !=="GN")
                        {{$Data['InStock'] - $Data['PemakaianMylea']}}
                        @else
                        {{$Data['InStock'] - $Data['PemakaianComposite']}}
                        @endif
                    </td>
                    <td>{{$Data['TanggalBibit']}}</td>
                    <td>{{$Data['JumlahBibit']}}</td>
                    <td>{{$Data['KeteranganBibit']}}</td>
                </tr>
                @endforeach
                @endif
            <table>
            </div>
        </div>

        <div id="break"></br></div>
        <div id="header" style="display:none;">
            <center>
                <img src="https://drive.google.com/uc?export=view&id=1a_NtUSJ2nfqUYIMOTucalGRGd2ckyU2U">
                <h2>Baglog Production Report</h2>
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
            function ExportToExcel(type, fn, dl) {
                var elt = document.getElementById('tbl_exporttable_to_xls');
                var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
                return dl ?
                    XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                    XLSX.writeFile(wb, fn || ('ReportBaglog_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.' + (type || 'xlsx')));
                }
            
                
        </script>
        @include('admin.baglog.ExportDataJS.ExportDataJS')
        @endif
        @endif
    </section>

@endsection