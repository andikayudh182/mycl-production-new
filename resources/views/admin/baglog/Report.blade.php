@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol> 
    </nav>
    </div>
    <section class="m-5">
        <div class="row align-items-start">
            <div class="col-4">
                <a href="{{url('/admin/baglog/report-mixing')}}">Data Mixing</a>
            </div>
            <div class="col-4">
                <a href="{{url('/admin/baglog/report-sterilisasi')}}">Data Sterilisasi</a>
            </div>
            <div class="col-4">
                <a href="{{url('/admin/baglog/report/baglog-making-report')}}">Baglog Making Report</a>
            </div>
        </div>
    </section>
    <section class="m-5 container">
        <div class="container">
            <div class="row">
                <div class="col-md-10" style="float: left; display:inline-block;">
                    <h3>Baglog Production Report</h3>
                </div>
                <div class="col-md-2 " style="float: right;">
                    <a class="btn btn-primary" href="{{url('/admin/baglog/report/export-data')}}" role="button">Export Data</a>
                </div>
            </div>
            <div class="row">
                <form action="{{url('/admin/baglog/report')}}" method="GET">
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
                    <h3>Total In Stock : {{$InStock}}</h3>    
                </div>
            </div>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('message2'))
        <div class="alert alert-danger">
            {{ session()->get('message2') }}
        </div>
        @endif
        {{ $Data[0]['idBaglog'] }}
        <div class="table-responsive">
            <table class = "table">
                <tr>
                    <th>@sortablelink('KodeProduksi','Kode Produksi')</th>
                    <th>Jenis Baglog</th>
                    <th>@sortablelink('TanggalPembibitan','Tanggal Pembibitan')</th>
                    <th>Jumlah Baglog</th>
                    <th>Jumlah Kontaminasi</th>
                    <th>Contamination Rate</th>
                    <th>Harvested Baglog</th>
                    <th>In Stock</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>@sortablelink('TanggalBibit','Tanggal Bibit')</th>
                    <th>Jumlah Bibit</th>
                    <th>Keterangan Bibit</th>
                    <th></th>  
                    <th> </th>
                    <th> </th>
                    <th> </th>
                </tr>
                @foreach($Data as $data1)
                <tr>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DetailProduksi{{$data1['idBaglog']}}" data-bs-dismiss="modal">
                            {{$data1['KodeProduksi']}}
                        </button> 
                        @include('admin.baglog.DetailProduksiBaglogPartial') 
                    </td>
                    <td>
                        {{-- @if (substr($data1['KodeProduksi'],0,4)=='BLTP')
                            Tempe
                        @elseif (substr($data1['KodeProduksi'],0,4)=='BLGN')
                            GN
                        @endif --}}
                        @if($data1['JenisBibit']=='TP')
                            Tempe
                        @else
                            {{ $data1['JenisBibit'] }}
                        @endif
                    </td>
                    <td><?php echo $data1['TanggalPembibitan'];?></td>
                    <td>{{$data1['JumlahBaglog']}}</td>
                    <td>{{$data1['Kontaminasi']}}</td>
                    <td>{{$data1['ContaminationRate']}}</td>
                    <td>{{$data1['InStock']}}</td>
                    <td>
                        @if($data1['JenisBibit'] !=="GN")
                        {{$data1['InStock'] - $data1['PemakaianMylea']}}
                        @else
                        {{$data1['InStock'] - $data1['PemakaianComposite']}}
                        @endif
                    </td>
                    <td>{{$data1['Lokasi']}}</td>
                    <td>{{$data1['Keterangan']}}</td>
                    <td>{{$data1['TanggalBibit']}}</td>
                    <td>{{$data1['JumlahBibit']}}</td>
                    <td>{{$data1['KeteranganBibit']}}</td>
                    <td><a href="{{ route('BaglogKonta', ['KodeProduksi'=>$data1['KodeProduksi'],])}}">Data Kontaminasi</a></td>
                    <td><a href="{{ route('AddKontaBaglog', ['KodeProduksi'=>$data1['KodeProduksi'],])}}">Form Kontaminasi</a></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UjiCobaModal{{$data1['idBaglog']}}" data-bs-dismiss="modal">
                            Form Uji Coba
                        </button>
                        @include('admin.baglog.Partials.FormUjiCobaPartial') 
                    </td>  
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal{{$data1['idBaglog']}}" data-bs-dismiss="modal">
                            Edit
                        </button>
                        @include('admin.baglog.EditReportPartial') 
                    </td> 
                    <td><a href="{{url('admin/baglog/report-delete', ['id'=>$data1['idBaglog'],])}}" class="btn btn-primary">Delete</a></td>  
                </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
        </div>
    </section>

@endsection