@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-3 Report</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($MPT3 as $data)
        <h3>{{$data['KodeProduksi']}}</h3>
        Grade :{{$data['Grade']}} <br>
        Details : {{$Details[0]['KategoriReinforce'].', '.$Details[0]['Warna']}}
        <table class="table mt-2">
            <tr>
                <th>Proses</th>
                <th>Status</th>
                <th>Tanggal Pengerjaan</th>
            </tr>
            <tr>
                <td>Pressing</td>
                <?php
                    if ($data['StatusPressing']==''){               
                        echo "<td>Belum Dikerjakan</td>";                
                    } else {
                        echo "<td>Sudah Dikerjakan</td>";               
                    }
                ?>
                <td><?php echo $data['TanggalPressing'];?></td>
                <td><a href="{{route('MPT3-Report-Submit', ['id'=>$data['id'], 'case'=>'Pressing'])}}">Kerjakan</a></td>
            </tr>
        </table>
    @endforeach
</section>
@endsection