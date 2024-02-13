@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/production-report') }}">Produksi Mylea</a></li>
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
            </tr>
            @foreach ($MyleaKonta as $data)
            <tr>
                <td><?php echo $data['id']?></td>
                <td><?php echo $data['KodeProduksi']?></td>
                <td><?php echo $data['TanggalKonta']?></td>
                <td><?php echo $data['Jumlah']?></td>
                <td><?php echo $data['Keterangan']?></td>
                <td><a href="{{url('/operator/mylea/report/kontaminasi-delete', ['id'=>$data['id'],])}}">Delete</a></td>
            </tr> 
            @endforeach

        </table>
</section>
@endsection