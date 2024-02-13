@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biobo Post Treament 2 Data</li>
            </ol>
        </nav>
    </section>


    <section class="m-5">
        <h3>Data Post Treament 2 Biobo</h3>
        <table class="table">
            <tr>
                <th>No Batch</th>
                <th>Tanggal Terima</th>
                <th>10x15</th>
                <th>10x20</th>
                <th>30x30</th>
                <th>Tanggal Sanding</th>
                <th>10x15</th>
                <th>10x20</th>
                <th>30x30</th>
                <th>Tanggal Cutting</th>
                <th>10x15</th>
                <th>10x20</th>
                <th>30x30</th>
                <th>Deviasi 10x15</th>
                <th>Deviasi 10x20</th>
                <th>Deviasi 30x30</th>
            </th>
            @foreach($Data as $data)
            <tr>
                <td><?php echo $data['NoBatch']?></td>
                <td><?php echo $data['Tanggal']?></td>
                <td><?php echo $data['U10x15']?></td>
                <td><?php echo $data['U10x20']?></td>
                <td><?php echo $data['U30x30']?></td>
                <td><?php echo $data['TanggalSanding']?></td>
                <td><?php echo $data['PSanding10x15']?></td>
                <td><?php echo $data['PSanding10x20']?></td>
                <td><?php echo $data['PSanding30x30']?></td>
                <td><?php echo $data['TanggalCutting']?></td>
                <td><?php echo $data['PCutting10x15']?></td>
                <td><?php echo $data['PCutting10x20']?></td>
                <td><?php echo $data['PCutting30x30']?></td>
                <td><?php echo $data['U10x15'] - $data['PCutting10x15'] ?></td>
                <td><?php echo $data['U10x20'] - $data['PCutting10x20'] ?></td>
                <td><?php echo $data['U30x30'] - $data['PCutting30x30']?></td>

            </tr>
            @endforeach
        </table>		
    </section>
@endsection
