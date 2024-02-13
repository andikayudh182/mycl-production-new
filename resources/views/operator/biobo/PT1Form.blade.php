@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo') }}">Biobo</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo/post-treatment-1') }}">Post Treatment 1</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Input</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h3>Post Treatment 1 Biobo</h3>
    <form method="POST" action="{{url('/operator/biobo/pt-1-submit')}}">
        @csrf
        <div class="row mb-3 ">
            <label for="NoBatch" class="col-sm-2 col-form-label col-form-label-sm">No Batch :</label>
            <div class="col-sm-5">
                <input type="text" name="NoBatch" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal :</label>
            <div class="col-sm-5">
                <input type="date" name="Tanggal" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Harvested Biobo</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][HarvestedBiobo]" class="form-select" id="HarvestedBiobo">
                        @foreach($DataHarvest as $item)
                        <option value="{{$item['id']}}">{{$item['TanggalPanen'].', Ukuran : '.$item['Ukuran']. ', In Stock : ' . $item['InStock']}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Data</button></td>
            </tr>
        </table>   
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><select name="data['+i+'][HarvestedBiobo]" class="form-select" id="HarvestedBiobo"> @foreach($DataHarvest as $item)<option value="{{$item['id']}}">{{$item['TanggalPanen'].', Ukuran : '.$item['Ukuran']. ', In Stock : ' . $item['InStock']}}</option> @endforeach </select> </td><td><input type="number" name="data['+i+'][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>
@endsection