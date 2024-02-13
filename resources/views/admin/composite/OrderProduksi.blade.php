@extends('layouts.admin')

@section('content')

<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Produksi Composite</li>
        </ol>
    </nav>
</div>
<section class="m-5">
    <h2>Order Produksi Composite</h2>
    <form class="mt-4" method="POST" action="{{url('admin/composite/order-produksi/submit')}}">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalProduksi" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Produksi :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalProduksi" class="form-control form-control-sm @error('TanggalProduksi') is-invalid @enderror" id="colFormLabelSm">
                @error('TanggalProduksi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisBaglog" class="col-sm-2 col-form-label col-form-label-sm">Jenis Baglog :</label>
            <div class="col-sm-5">
                {{-- <select name="JenisBaglog" class="form-control form-control-sm @error('JenisBaglog') is-invalid @enderror" id="colFormLabelSm">
                    <option value="GN">GN</option>
                    <option value="AsaAgro">Asa Agro</option>
                    <option value="Tempe">Tempe</option>
                </select> --}}
                <input type="text" class="form-control form-control-sm"  name="JenisBaglog"  @error('JenisBaglog') is-invalid @enderror value="GN" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JenisComposite" class="col-sm-2 col-form-label col-form-label-sm">Jenis Composite :</label>
            <div class="col-sm-5">
                <select name="JenisComposite" class="form-control form-control-sm @error('JenisComposite') is-invalid @enderror" id="colFormLabelSmComposite">
                    <option value="">Pilih Jenis Composite</option>
                    @foreach ($VariantComposite as $JenisComposite )
                    <option value="<?php echo $JenisComposite['id']?>">{{ $JenisComposite['Nama'] }}</option>
                    @endforeach   
                </select>
                @error('JenisComposite')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="JumlahComposite" class="col-sm-2 col-form-label col-form-label-sm">Jumlah Composite :</label>
            <div class="col-sm-5">
                <input name="JumlahComposite" class="form-control form-control-sm @error('JumlahComposite') is-invalid @enderror" id="colFormLabelSm" type="number">
                @error('JumlahComposite')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Lokasi" class="col-sm-2 col-form-label col-form-label-sm">Lokasi</label>
            <div class="col-sm-5">
                <input name="Lokasi" class="form-control form-control-sm @error('Lokasi') is-invalid @enderror" id="colFormLabelSm" type="text">
                @error('Lokasi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Kode Produksi Baglog</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][KodeBaglog]" class="form-select" id="KodeBaglog">
                        @foreach ($Data as $data)
                            @if ($data['InStock'] > 0)
                                @php
                                    $sterilisasiGNFound = false;
                                @endphp
                    
                                @foreach ($data['Sterilisasi'] as $sterilisasi)
                                    @if ($sterilisasi->JenisBibit === 'GN')
                                        <option value="{{ $data['KodeProduksi'] }}">
                                            {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
                                        </option>
                                        @php
                                            $sterilisasiGNFound = true;
                                        @endphp
                                        @break
                                    @endif
                                @endforeach
                    
                                @if (!$sterilisasiGNFound)
                                    <!-- Opsi jika tidak ada sterilisasi dengan JenisBibit 'GN' -->
                                    <option value="{{ $data['KodeProduksi'] }}">
                                        {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] . '(Bukan GN / Belum Ada Jenis Bibit)' }}
                                    </option>
                                @endif
                            @endif 
                        @endforeach
                    </select>
                    
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Baglog</button></td>
            </tr>
        </table>      
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
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
        var i = 0;
        $("#dynamic-ar").click(function () {
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
            var newRow = '<tr><td><select name="data[' + i + '][KodeBaglog]" class="form-select" id="KodeBaglog">' + newOption + '</select></td><td><input type="number" name="data[' + i + '][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>';
            $("#dynamicAddRemove").append(newRow);
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>

@endsection

{{-- <p>{{ $Data }}</p> --}}