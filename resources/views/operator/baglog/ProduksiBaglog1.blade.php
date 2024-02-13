@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/baglog') }}">Produksi Baglog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tahap 1 Produksi Baglog</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <h3>Data Order Mixing</h3>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <table class="table">
        <tr>
                <th>No</th>
                <th>No Recipe</th>
                <th>Tanggal Mixing</th>
                <th>Tanggal Sterilisasi</th>
                <th>Batch Sterilisasi</th>
                <th>Status Order</th>
        </tr>

        @foreach ($OrderMixing as $data)
        @if ($data['StatusSterilisasi']==NULL)
            <tr>
                <td><?php echo $data['id'];?></td>
                <td><?php echo $data['NoRecipe'];?></td>
                <td><?php echo $data['TanggalMixing'];?></td>
                <td>{{$data['TanggalSterilisasi']}}</td>
                <td><?php echo $data['BatchSterilisasi'];?></td>
                <td>{{$data['StatusOrder']}}</td>
                {{-- <td>{{$data['StatusSterilisasi']}} tes</td> --}}
                <td><a href="{{route('DetailMixing', ['NoRecipe'=>$data->NoRecipe])}}">Detail</a></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#MixingModal{{$data['id']}}">
                        Submit Mixing
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SterilisasiModal{{$data['id']}}">
                        Submit Sterilisasi
                    </button>
                </td>  
                @include('operator.baglog.MixingFormPartial')
                @include('operator.baglog.SterilisasiFormPartial')                 
            </tr> 
        @endif
        @endforeach

    </table>
</section>
@endsection