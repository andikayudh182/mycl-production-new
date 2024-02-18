@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite')}}">Composite</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/composite/report')}}">Report Composite</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontaminasi</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h3>Kontaminasi</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Produksi</th>
                <th>Tanggal Kontaminasi</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th colspan="2" class="text-center">Aksi</th>
            </tr>
            @foreach ($CompositeKonta as $data)
            <tr>
                <td><?php echo $data['id']?></td>
                <td><?php echo $data['KodeProduksi']?></td>
                <td><?php echo $data['TanggalKonta']?></td>
                <td><?php echo $data['Jumlah']?></td>
                <td><?php echo $data['Keterangan']?></td>
                <td><a href="{{url('/admin/composite/report/kontaminasi-edit', ['id'=>$data['id'],])}}">Edit</a></td>
                <td><a href="{{url('/admin/composite/report/kontaminasi-delete', ['id'=>$data['id'],])}}">Delete</a></td>
            </tr> 
            @endforeach

        </table>
</section>
@endsection