@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-4</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($QC1 as $QC1)
    <h3>Post Treatment 4 : {{$QC1['KodeProduksi']}}
    </h3>
    <h5>
        Grade A : <?php echo $QC1['GradeA'];?></br>
        Grade E : <?php echo $QC1['GradeE'];?></br>
    </h5>
    <table class="table m-4">
        <tr>
            <th>No</th>
            <th>Grade</th>
            <th>Jumlah</th>
            <th>Kategori Reinforce</th>
            <th>Warna</th>
        </tr>
        @foreach ($QDetails as $data)
         <tr>
             <td>{{$data['id']}}</td>
             <td>{{$data['Grade']}}</td>
             <td>{{$data['Jumlah']}}</td>
             <td>{{$data['KategoriReinforce']}}</td>
             <td>{{$data['Warna']}}</td>
             <td><a href="{{route('MPT4-Report', ['id'=>$data['id'],])}}">Report Produksi</a></td>
        </tr>   
        @endforeach
    </table>
    @endforeach
</section>
@endsection