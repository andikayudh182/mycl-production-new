@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-4 Report</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($MPT4 as $data)
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
                <td>Cutting</td>
                <?php
                    if ($data['StatusCutting']==''){               
                        echo "<td>Belum Dikerjakan</td>";                
                    } else {
                        echo "<td>Sudah Dikerjakan</td>";               
                    }
                ?>
                <td><?php echo $data['TanggalCutting'];?></td>
                <td><a href="{{route('MPT4-Report-Submit', ['id'=>$data['id'], 'case'=>'Cutting'])}}">Kerjakan</a></td>
            </tr>
            <tr>
                <td>Coating & Pigmen*</td>
                <?php
                    if ($data['StatusCoatingPigmen']==''){               
                        echo "<td>Belum Dikerjakan</td>";                
                    } else {
                        echo "<td>Sudah Dikerjakan</td>";               
                    }
                ?>
                <td><?php echo $data['TanggalCoatingPigmen'];?></td>
                <td><a href="{{route('MPT4-Report-Submit', ['id'=>$data['id'], 'case'=>'CoatingPigmen'])}}">Kerjakan</a></td>
            </tr>
            <tr>
                <td>Pengeringan Coating</td>
                <?php
                    if ($data['StatusPengeringan4']==''){               
                        echo "<td>Belum Dikerjakan</td>";                
                    } else {
                        echo "<td>Sudah Dikerjakan</td>";               
                    }
                ?>
                <td><?php echo $data['TanggalPengeringan4'];?></td>
                <td><a href="{{route('MPT4-Report-Submit', ['id'=>$data['id'], 'case'=>'Pengeringan4'])}}">Kerjakan</a></td>
            </tr>
        </table>
    @endforeach
</section>
@endsection