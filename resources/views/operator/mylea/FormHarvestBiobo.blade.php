@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Mylea</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h3>Biobo Form</h3>

    
    <form method="POST" action="{{url('/operator/mylea/production-report/submit-biobo')}}">
        @csrf
        @foreach($Data as $data)
        <h5 class="m-2">Kode Produksi Mylea : {{$data['KodeProduksi']}}</h5>
        <input type="hidden" id="KodeProduksi" name="KodeProduksi" value="{{$data['KodeProduksi']}}">
        @endforeach
        <div class="row mb-3 ">
            <label for="TanggalPanen" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Panen :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalPanen" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Quality</th>
                <th>Ukuran</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="data[0][Quality]" class="form-select" id="Quality">
                        <option value="Passed">Passed</option>
                        <option value="Reject">Reject</option>
                    </select>
                </td>
                <td>
                    <select name="data[0][Ukuran]" class="form-select" id="Ukuran">
                        <option value="10x15">10x15</option>
                        <option value="10x20">10x20</option>
                        <option value="30x30">30x30</option>
                    </select>
                </td>
                <td><input type="number" name="data[0][Jumlah]" class="form-control" /></td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Data</button></td>
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
                $("#dynamicAddRemove").append('<tr><td><select name="data[' +i+ '][Quality]" class="form-select" id="Quality"><option value="Passed">Passed</option><option value="Reject">Reject</option></select></td><td><select name="data[' +i+ '][Ukuran]" class="form-select" id="Ukuran"><option value="10x15">10x15</option><option value="10x20">10x20</option><option value="30x30">30x30</option></select></td><td><input type="number" name="data[' +i+ '][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
            });
            $(document).on('click', '.remove-input-field', function () {
                $(this).parents('tr').remove();
            });
        </script>
</section>
@endsection