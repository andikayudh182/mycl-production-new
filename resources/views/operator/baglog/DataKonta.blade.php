@extends('layouts.operator')
@section('content')
    <div class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/operator/baglog/qcbaglog') }}">QC Baglog</a></li>
                <li class="breadcrumb-item active" aria-current="page">QC Baglog</li>
            </ol>
        </nav>
    </div>

    <section class="m-5 container">
        <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Produksi</th>
                <th>Jumlah Kontaminasi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
            
            @foreach ( $data as $data )
            <tr>
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['KodeProduksi'];?></td>
                <td><?php echo $data['JumlahKontaminasi'];?></td>
                <td><?php echo $data['Tanggal'];?></td>
                <td><?php echo $data['Keterangan'];?></td>
                <td><a href="{{ route('DeleteKontaBaglogOperator', ['id'=>$data['id'],])}}">Delete</a></td>
            </tr>
            @endforeach


        </table>
    </section>

@endsection