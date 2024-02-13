@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo/harvest')}}">Biobo Harvest</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biobo Harvest Edit Form</li>
            </ol>
        </nav>
    </section>
<section class="m-5">
    <h2>Harvest Biobo</h2>
    @foreach($Data as $data)
    <form action="{{url('/admin/biobo/harvest-submit', ['id'=>$data['id'],])}}" method="POST">
        @csrf
        <div class="row mb-3 ">
            <label for="TanggalPanen" class="col-sm-2 col-form-label col-form-label-sm">Tanggal Panen :</label>
            <div class="col-sm-5">
                <input type="date" name="TanggalPanen" class="form-control form-control-sm" id="colFormLabelSm" value="{{$data['TanggalPanen']}}">
            </div>
        </div>
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Quality</th>
                <th>Ukuran</th>
                <th>Tanggal Produksi</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>
                    <select name="Quality" class="form-select" id="Quality">
                        <option value="{{$data['Quality']}}">{{$data['Quality']}}</option>
                        <option value="Passed">Passed</option>
                        <option value="Reject">Reject</option>
                    </select>
                </td>
                <td>
                    <select name="Ukuran" class="form-select" id="Ukuran">
                        <option value="{{$data['Ukuran']}}">{{$data['Ukuran']}}</option>
                        <option value="10x15">10x15</option>
                        <option value="10x20">10x20</option>
                        <option value="30x30">30x30</option>
                    </select>
                </td>
                <td><input type="date" name="TanggalProduksi" class="form-control" value="{{$data['TanggalProduksi']}}"></td>
                <td><input type="number" name="Jumlah" class="form-control" value="{{$data['Jumlah']}}"/></td>
            </tr>
        </table>      
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto">
    </form>
    @endforeach
</section>

@endsection

