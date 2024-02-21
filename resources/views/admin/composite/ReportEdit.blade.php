@extends('layouts.admin')

@section('content')

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Composite</li>
        </ol>
    </nav>
</div>

{{-- @foreach ( $BaglogAdmin as $data )
    {{ $data['KodeBaglog'] }}
@endforeach --}}

{{-- Alert Message --}}
@if (session()->has('success'))
    <div class="d-flex justify-content-center align-items-center">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; text-align: center;">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>          
@endif
{{-- End Alert --}}




<section class="m-5">
    <div class="d-flex justify-content-center m-3">
        <h3>Input Produksi Composite {{$KodeProduksi}}</h3>
    </div>
    <form method="POST" action="{{url('/admin/composite/report-submit', ['id'=>$id,])}}">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalProduksi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Produksi :</label>
            <div class="col-sm-5">
                <input type="hidden" name="KodeProduksi" value="{{ $KodeProduksi }}">
                <input type="date" name="TanggalProduksi" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $CompositeProduction[0]['TanggalProduksi']?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jenis Baglog :</label>
            <div class="col-sm-5">
                {{-- <select name="JenisBaglog" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="<?php echo $CompositeProduction[0]['JenisBaglog'];?>"><?php echo $CompositeProduction[0]['JenisBaglog'];?></option>
                    <option value="GN">GN</option>
                    <option value="Tempe">Tempe</option>
                    <option value="AsaAgro">Asa Agro</option>
                </select> --}}

                <input type="text" class="form-control form-control-sm"  name="JenisBaglog"  @error('JenisBaglog') is-invalid @enderror value="<?php echo $CompositeProduction[0]['JenisBaglog'];?>" readonly>
 
            </div>
        </div>
        
        <div class="row mb-3 ">
            <label for="JenisComposite" class="col-sm-2 col-form-label col-form-label-sm">Jenis Composite :</label>
            <div class="col-sm-5">
                <select name="JenisComposite" class="form-control form-control-sm @error('JenisComposite') is-invalid @enderror" id="colFormLabelSmComposite">
                    @if($CompositeProduction[0]['JenisComposite'])
                    <option value="<?php echo $CompositeProduction[0]['JenisComposite']?>">{{ $CompositeProduction[0]['Nama'] }}</option>
                    @else
                    <option value="">Pilih Jenis Composite</option>
                    @endif

                    @foreach ($VariantComposite as $JenisComposite )
                    <option value="<?php echo $JenisComposite['id']?>">{{ $JenisComposite['Nama'] }}</option>
                    @endforeach   
                </select>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Baglog :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahBaglog" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $CompositeProduction[0]['JumlahBaglog'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahComposite" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Composite :</label>
            <div class="col-sm-5">
                <input type="number" name="JumlahComposite" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $CompositeProduction[0]['JumlahComposite'];?>">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi :</label>
            <div class="col-sm-5">
                <input type="text" name="Lokasi" class="form-control form-control-sm" id="colFormLabelSm" value="<?php echo $CompositeProduction[0]['Lokasi'];?>">
            </div>
        </div>

    
        <div class="row mb-3">
            <div class="col-sm-7">
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <th>Kode Produksi Baglog (Admin)</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    @if ($BaglogAdmin->isEmpty())
                    <tr>
                        <td>
                            <select name="data1[0][KodeBaglog]" class="form-select">
                                @foreach ($Data as $data)
                                    @if ($data['InStock'] > 0)
                                        @foreach ($data['Sterilisasi'] as $sterilisasi)
                                            @if ($sterilisasi->JenisBibit === 'GN')
                                                <option value="{{ $data['KodeProduksi'] }}">
                                                    {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif 
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="data1[0][Jumlah]" class="form-control" />
                        </td>
                        <td>
                             <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Baglog</button>
                        </td>
                    </tr>

                    @else

                    @foreach ($BaglogAdmin as $index => $dataBaglog1)
                        <tr>
                            <td>
                                <select name="data1[{{ $index }}][KodeBaglog]" class="form-select">
                                    @foreach ($Data as $data)
                                        @if ($data['InStock'] > 0)
                                            @php
                                                $sterilisasiGNFound = false;
                                            @endphp
                                            @foreach ($data['Sterilisasi'] as $sterilisasi)
                                                @if ($sterilisasi->JenisBibit === 'GN')
                                                    <option value="{{ $data['KodeProduksi'] }}"
                                                        @if ($dataBaglog1['KodeBaglog'] == $data['KodeProduksi'])
                                                            selected
                                                        @endif
                                                    >
                                                        {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
                                                    </option>
                                                    @php
                                                        $sterilisasiGNFound = true;
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif 
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="data1[{{ $index }}][Jumlah]" class="form-control" value="{{ $dataBaglog1['Jumlah'] }}" /></td>
                            <td>
                                @if ($index > 0)
                                    <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                                @else
                                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Baglog</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-7">
                <table class="table table-bordered" id="dynamicAddRemove2">
                    <tr>
                        <th>Kode Produksi Baglog (Operator)</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                    @if ($BaglogOperator->isEmpty())
                    <tr>
                        <td>
                            <select name="data2[0][KodeBaglog]" class="form-select">
                                @foreach ($Data as $data)
                                    @if ($data['InStock'] > 0)
                                        @foreach ($data['Sterilisasi'] as $sterilisasi)
                                            @if ($sterilisasi->JenisBibit === 'GN')
                                                <option value="{{ $data['KodeProduksi'] }}">
                                                    {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif 
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="data2[0][Jumlah]" class="form-control" />
                        </td>
                        <td>
                             <button type="button" name="add" id="dynamic-ar2" class="btn btn-outline-primary">Tambah Baglog</button>
                        </td>
                    </tr>
                    @else

                    @foreach ($BaglogOperator as $index => $dataBaglog2)
                        <tr>
                            <td>
                                <select name="data2[{{ $index }}][KodeBaglog]" class="form-select">
                                    @foreach ($Data as $data)
                                        @if ($data['InStock'] > 0)
                                            @php
                                                $sterilisasiGNFound = false;
                                            @endphp
                                            @foreach ($data['Sterilisasi'] as $sterilisasi)
                                                @if ($sterilisasi->JenisBibit === 'GN')
                                                    <option value="{{ $data['KodeProduksi'] }}"
                                                        @if ($dataBaglog2['KodeBaglog'] == $data['KodeProduksi'])
                                                            selected
                                                        @endif
                                                    >
                                                        {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
                                                    </option>
                                                    @php
                                                        $sterilisasiGNFound = true;
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif 
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="data2[{{ $index }}][Jumlah]" class="form-control" value="{{ $dataBaglog2['Jumlah'] }}" /></td>
                            <td>
                                @if ($index > 0)
                                    <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                                @else
                                    <button type="button" name="add" id="dynamic-ar2" class="btn btn-outline-primary">Tambah Baglog</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>

    <script>
        const selectElement = document.getElementById('colFormLabelSmComposite');
    
        selectElement.addEventListener('change', function() {
            const optionPilihJenisComposite = selectElement.querySelector('option[value=""]');
            optionPilihJenisComposite.disabled = true;
        });
    </script>

      <!-- JavaScript -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
            var i = {{ $BaglogAdmin->isEmpty() ? 0 : count($BaglogAdmin) }};
            $("#dynamic-ar").click(function(){
                var newOption = '';
                @foreach ($Data as $data)
                    @if ($data['InStock'] > 0)
                        @foreach ($data['Sterilisasi'] as $sterilisasi)
                            @if ($sterilisasi->JenisBibit === 'GN')
                                newOption += '<option value="{{ $data['KodeProduksi'] }}">{{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}</option>';
                                @break
                            @endif
                        @endforeach
                    @endif 
                @endforeach
                var newRow = '<tr><td><select name="data1[' + i + '][KodeBaglog]" class="form-select" id="KodeBaglog">' + newOption + '</select></td><td><input type="number" name="data1[' + i + '][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Hapus</button></td></tr>';
                $("#dynamicAddRemove").append(newRow);
                i++;
            });
            $(document).on('click', '.remove-input-field', function(){
                $(this).parents('tr').remove();
            });
        });
      </script>
      <script type="text/javascript">
           var i = {{ $BaglogOperator->isEmpty() ? 0 : count($BaglogOperator) }};
          $("#dynamic-ar2").click(function () {
              ++i;
              var newOption = '';
              @foreach ($Data as $data)
                  @if ($data['InStock'] > 0)
                      @foreach ($data['Sterilisasi'] as $sterilisasi)
                          @if ($sterilisasi->JenisBibit === 'GN')
                              newOption += '<option value="{{ $data['KodeProduksi'] }}">{{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}</option>';
                              @break
                          @endif
                      @endforeach
                  @endif 
              @endforeach
              var newRow = '<tr><td><select name="data2[' + i + '][KodeBaglog]" class="form-select" id="KodeBaglog">' + newOption + '</select></td><td><input type="number" name="data2[' + i + '][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>';
              $("#dynamicAddRemove2").append(newRow);
          });
          $(document).on('click', '.remove-input-field', function () {
              $(this).parents('tr').remove();
          });
      </script>
      
</section>

@endsection 