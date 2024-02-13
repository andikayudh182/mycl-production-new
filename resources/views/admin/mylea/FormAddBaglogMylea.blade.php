@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report Mylea</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h2>Produksi Mylea</h2>
    <form action="{{url('/admin/mylea/report/data-baglog-add-submit', ['KodeProduksi' => $KodeProduksi,])}}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="JenisInput" class="col-sm-2 col-form-label col-form-label-sm">Input :</label>
            <div class="col-sm-5">
                <select name="JenisInput" class="form-control form-control-sm @error('JenisInput') is-invalid @enderror" id="colFormLabelSm">
                    <option value="Admin">Admin</option>
                    <option value="Operator">Operator</option>
                </select>
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
                            @if(($data['InStock']) > '0'){
                                <option value="<?php echo $data['KodeProduksi']?>">{{$data['KodeProduksi'].' : '.$data['InStock']}}</option>
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
            $("#dynamicAddRemove").append('<tr><td>    <select name="data['+ i +'][KodeBaglog]" class="form-select" id="KodeBaglog">        @foreach ($Data as $data)            @if(($data['InStock']) > '0'){<option value="<?php echo $data['KodeProduksi']?>">{{$data['KodeProduksi'].' : '.$data['InStock']}}</option>            @endif         @endforeach    </select></td><td><input type="number" name="data['+ i +'][Jumlah]" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
</section>

@endsection

