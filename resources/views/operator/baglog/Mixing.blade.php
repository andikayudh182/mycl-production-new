@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mixing</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Data Order Mixing</h3>
    <table class="table">
        <tr>
                <th>No</th>
                <th>No Recipe</th>
                <th>Tanggal Mixing</th>
        </tr>

        @foreach ($OrderMixing as $data)
        @if ($data['Status']=='0')
            <tr>
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['NoRecipe'];?></td>
                <td><?php echo $data['TanggalMixing'];?></td>
                <td><a href="{{route('DetailMixing', ['NoRecipe'=>$data->NoRecipe])}}">Detail</a></td>
                <td><a href="{{route('UpdateMixing', ['id'=>$data->id])}}">Kerjakan</a></td>
                
            </tr> 
        @endif
        @endforeach

    </table>
</section>
@endsection