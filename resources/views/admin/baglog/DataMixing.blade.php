@extends('layouts.admin')
@section('content')
    <div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: white">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog')}}">Baglog</a></li>
            <li class="breadcrumb-item"><a href="{{url('/admin/baglog/report')}}">Report</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mixing</li>
        </ol> 
    </nav>
    </div>

    <section class="m-5 container">
        <h3>Data Mixing</h3>
        <table class = "table">
            <tr>
                <th>No</th>
                <th>No Recipe</th>
                <th>Tanggal Mixing</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
            @foreach ($Data as $data )
            <tr>
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['NoRecipe'];?></td>
                <td><?php echo $data['TanggalMixing'];?></td>
                @if($data['Status']=='1')
                    <td>Sudah dikerjakan</td>
                @else
                    <td>Belum dikerjakan</td>
                @endif
                <td>{{$data['Keterangan']}}</td>
                <td><a href="{{route('FormEditMixing', ['id'=>$data['id'],])}}">Edit</a></td>
                <td><a href="{{route('DeleteMixing', ['id'=>$data['id'],])}}">Delete</a></td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
        </div>
    </section>

@endsection