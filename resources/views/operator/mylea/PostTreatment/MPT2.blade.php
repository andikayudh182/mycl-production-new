@extends('layouts.operator')
@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment/monitoring') }}">Proses Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">MPT-2</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    @foreach($QC1 as $QC1)
    <h3>Post Treatment 2 : {{$QC1['KodeProduksi']}}
    </h3>
    <h5>
        Grade A : <?php echo $QC1['GradeA'];?></br>
        Grade E : <?php echo $QC1['GradeE'];?></br>
    </h5>

    <p class="m-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Form Pilihan Produksi
        </button>
    </p>
    <div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form method="POST" class="m-5" action="{{route('MPT2-Submit', ['KodeProduksi'=>$QC1['KodeProduksi'],])}}">
            @csrf
            <div class="row mb-3 ">
                <label for="KategoriReinforce" class="col-sm-2 col-form-label col-form-label-sm">Kategori Reinforce :</label>
                <div class="col-sm-5">
                    <select name="KategoriReinforce" class="form-control form-control-sm" id="colFormLabelSm">
                        <option value="Reinforce">Reinforce</option>
                        <option value="Tidak di Reinforce">Tidak di Reinforce</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Warna" class="col-sm-2 col-form-label col-form-label-sm">Warna :</label>
                <div class="col-sm-5">
                    <select name="Warna" class="form-control form-control-sm" id="colFormLabelSm">
                        <option value="Original">Original</option>
                        <option value="Black">Black</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 ">
                <label for="Grade" class="col-sm-2 col-form-label col-form-label-sm">Grade :</label>
                <div class="col-sm-5">
                    <select name="Grade" class="form-control form-control-sm" id="colFormLabelSm">
                        <option value="A">A</option>
                        <option value="E">E</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="Jumlah" class="col-sm-2 col-form-label col-form-label-sm">Jumlah :</label>
                <div class="col-sm-5">
                    <input type="number" name="Jumlah" class="form-control form-control-sm @error('Jumlah') is-invalid @enderror" id="colFormLabelSm" value="{{ old('Jumlah') }}">
                    @error('Jumlah')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <input type="submit" value="submit" name="submit" class="btn btn-primary float-auto">
        </form>
    </div>
    </div>
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
             <td><a href="{{route('MPT2-Report', ['id'=>$data['id'],])}}">Report Produksi</a></td>
             @if(Auth::user()->role == 'admin')
                <td><a href="{{route('DeleteQCDetails', ['id'=>$data['id'],])}}">Delete</a></td>
             @endif
        </tr>   
        @endforeach
    </table>
    @endforeach
</section>
@endsection