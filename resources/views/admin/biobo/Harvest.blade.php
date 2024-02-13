@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biobo Harvest</li>
            </ol>
        </nav>
    </section>

    <section class="m-5">
        <h3>Data Panen Biobo</h3>
        <table class="table">
            <tr>
                <th>Tanggal Panen</th>
                <th>Grade</th>
                <th>Ukuran</th>
                <th>Tanggal Produksi</th>
                <th>Jumlah</th>
            </th>
            @foreach ($Data as $item)
            <tr>
                <td><?php echo $item['TanggalPanen']?></td>
                <td><?php echo $item['Quality']?></td>
                <td><?php echo $item['Ukuran']?></td>
                <td><?php echo $item['TanggalProduksi']?></td>
                <td><?php echo $item['Jumlah']?></td>
                <td><a href="{{url('/admin/biobo/harvest-delete', ['id' => $item['id'],])}}">Delete</a></td>
                <td><a href="{{url('/admin/biobo/harvest-form', ['id' => $item['id'],])}}">Edit</a></td>
            </tr>               
            @endforeach
         </table>
         <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
        </div>
    </section>
@endsection

