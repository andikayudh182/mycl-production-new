@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/qc2') }}">Quality Control 2</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Quality Control 2</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <form method="POST" id="QC2" action="{{ url('/operator/mylea/post-treatment/qc2-form-submit') }}">
        @csrf
        <div class="row mb-3 ">
            <label for="KodeProduksi" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi :</label>
            <div class="col-sm-5">
                <input type="text" name="KodeProduksi"  value="{{$KodeProduksi}}" class="form-control form-control-sm" id="colFormLabelSm" readonly>
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="FinishDate" class="col-sm-2 col-form-label col-form-label-sm">Finish Date :</label>
            <div class="col-sm-5">
                <input type="date" name="FinishDate" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="mb-2">
            <h3>Data Input Awal</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Grade</th>
                    <th>Kategori Reinforce</th>
                    <th>Warna</th>
                    <th>Jumlah</th>
                </tr>
                @foreach ($DataPT as $item)
                <tr>
                    <td>{{$item['Grade']}}</td>
                    <td>{{$item['KategoriReinforce']}}</td>
                    <td>{{$item['Warna']}}</td>
                    <td>{{$item['Jumlah']}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <h3>Update Data</h3>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Grade</th>
                <th>Ukuran</th>
                <th>Kategori Reinforce</th>
                <th>Warna</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][Grade]" class="form-control form-control-sm" id="colFormLabelSm">
                        <option value="A">A</option>
                        <option value="E">E</option>
                    </select>
                </td>
                <td>                          
                    <select name="data[0][Ukuran]" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="20x20">20x20</option>
                        <option value="22x28">22x28</option>
                        <option value="22x32">22x32</option>
                        <option value="<20x20">&#60 20x20</option>
                        <option value="GradeC">Grade C</option>
                    </select>
                </td>
                <td>
                        <select name="data[0][KategoriReinforce]" class="form-control form-control-sm" id="colFormLabelSm">
                            <option value="Reinforce">Reinforce</option>
                            <option value="Tidak di Reinforce">Tidak di Reinforce</option>
                        </select>
                </td>
                <td>
                        <select name="data[0][Warna]" class="form-control form-control-sm" id="colFormLabelSm">
                            <option value="Original">Original</option>
                            <option value="Black">Black</option>
                        </select>
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah</button></td>
            </tr>
        </table> 
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto" id="submit">
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><select name="data[ '+ i +' ][Grade]" class="form-control form-control-sm" id="colFormLabelSm"><option value="A">A</option><option value="E">E</option></select></td><td><select name="data[ '+ i +' ][Ukuran]" class="form-control form-control-sm" id="colFormLabelSm"><option value="20x20">20x20</option><option value="22x28">22x28</option><option value="22x32">22x32</option><option value="<20x20">&#60 20x20</option><option value="GradeC">Grade C</option></select></td><td><select name="data[ '+ i +' ][KategoriReinforce]" class="form-control form-control-sm" id="colFormLabelSm"><option value="Reinforce">Reinforce</option><option value="Tidak di Reinforce">Tidak di Reinforce</option></select></td><td><select name="data[ '+ i +' ][Warna]" class="form-control form-control-sm" id="colFormLabelSm"><option value="Original">Original</option> <option value="Black">Black</option></select></td><td><input type="number" name="data[ '+ i +' ][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>

@endsection