@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quality Control 2</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Post Treatment Mylea</h3>
    <table class="table">
        <tr>
            <th>Kode Produksi</th>
            <th>Arrival Date</th>
            <th>Jenis Mylea</th>
            <th>Grade A</th>
            <th>Grade E</th>
        </tr>
        @foreach ($QC1 as $data)
        <tr>
            <td><?php echo $data['KodeProduksi'];?></td>
            <td><?php echo $data['ArrivalDate'];?></td>
            <td><?php echo $data['JenisMylea'];?></td>
            <td><?php echo $data['GradeA'];?></td>
            <td><?php echo $data['GradeE'];?></td>
            <td><a href="{{route('FormQC2', ['KodeProduksi'=>$data['KodeProduksi']])}}">Quality Control 2</a></td>        
        </tr>
        @endforeach

    </table>
</section>
@endsection