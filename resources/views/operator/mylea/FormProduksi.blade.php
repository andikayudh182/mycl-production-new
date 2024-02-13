@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/produksi-mylea') }}">Produksi Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Produksi Mylea</li>
        </ol>
    </nav>
</div>
<section class="m-5">
    <h2>Produksi Mylea</h2>
    <form action="{{url('/operator/mylea/produksi-mylea/submit-form-produksi', ['KodeProduksi' => $KodeProduksi,])}}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="Keterangan" class="col-sm-2 col-form-label col-form-label-sm">Keterangan :</label>
            <div class="col-sm-5">
                <input name="Keterangan" class="form-control form-control-sm @error('Keterangan') is-invalid @enderror" id="colFormLabelSm" type="text">
                @error('Keterangan')
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
                                $jenisBibitFound = false;
                            @endphp
                            @foreach ($data['Sterilisasi'] as $sterilisasi)
                                @if ($sterilisasi['JenisBibit'] === 'TP')
                                    @php
                                        $jenisBibitFound = true;
                                    @endphp
                                    @break
                                @endif
                            @endforeach
                            @if ($jenisBibitFound)
                                <option value="{{ $data['KodeProduksi'] }}">
                                    {{ $data['KodeProduksi'] . ' : ' . $data['InStock'] }}
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
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            var options = '';
            @foreach ($Data as $data)
                @if ($data['InStock'] > 0)
                    @php
                        $jenisBibitFound = false;
                    @endphp
                    @foreach ($data['Sterilisasi'] as $sterilisasi)
                        @if ($sterilisasi['JenisBibit'] === 'TP')
                            @php
                                $jenisBibitFound = true;
                            @endphp
                            @break
                        @endif
                    @endforeach
                    @if ($jenisBibitFound)
                        options += '<option value="{{ $data['KodeProduksi'] }}">{{$data['KodeProduksi'].' : '.$data['InStock']}}</option>';
                    @endif
                @endif
            @endforeach
            $("#dynamicAddRemove").append('<tr><td>    <select name="data['+ i +'][KodeBaglog]" class="form-select" id="KodeBaglog">' + options + '</select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>

@endsection

