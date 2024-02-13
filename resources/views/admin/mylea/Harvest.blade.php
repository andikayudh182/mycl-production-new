@extends('layouts.admin')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea')}}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/mylea/report')}}">Report Mylea</a></li>
            <li class="breadcrumb-item active" aria-current="page">Harvest</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <h3>Kontaminasi</h3>
        <table class="table">
            <tr>
                <th>Kode Produksi</th>
                <th>Jenis Panen</th>
                <th>Passed</th>
                <th>Reject</th>
            </tr>
            @foreach ($MyleaHarvest as $data)
            <tr>
                <td><?php echo $data['KodeProduksi']?></td>
                <td><?php echo $data['JenisPanen']?></td>
                <td><?php echo $data['Passed']?></td>
                <td><?php echo $data['Reject']?></td>
                <td><a href="{{url('/admin/mylea/report/harvest-delete', ['id'=>$data['id'], 'KodeProduksi'=>$data['KodeProduksi'],])}}">Delete</a></td>
            </tr>  
            @endforeach
        </table>
</section>
@endsection