@extends('layouts.admin')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Stock Card</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <div class="m-3">
        <div class="row g-2">
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                <b>Mylea Original Reinforce Grade A : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->sum('Jumlah')}}</b> <br>
                20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                22x28 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                22x32 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                 < 20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                GradeC : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Original Reinforce Grade E : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                 </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Original Tidak di Reinforce Grade A : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Original Tidak di Reinforce Grade E : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Original')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                <b>Mylea Black Reinforce Grade A : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->sum('Jumlah')}}</b> <br>
                20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                22x28 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                22x32 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                 < 20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                GradeC : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'A')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Black Reinforce Grade E : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Reinforce')->where('Grade', 'E')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                 </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Black Tidak di Reinforce Grade A : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'A')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
            <div class="col-3">
              <div class="p-5 border bg-light">
                <center>
                    <b>Mylea Black Tidak di Reinforce Grade E : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->sum('Jumlah')}}</b> <br>
                    20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '20x20')->sum('Jumlah')}} <br>
                    22x28 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '22x28')->sum('Jumlah')}} <br>
                    22x32 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '22x32')->sum('Jumlah')}} <br>
                     < 20x20 : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', '<20x20')->sum('Jumlah')}} <br>
                    GradeC : {{$data->where('Warna', 'Black')->where('KategoriReinforce', 'Tidak di Reinforce')->where('Grade', 'E')->where('Ukuran', 'GradeC')->sum('Jumlah')}} <br>
                </center>
              </div>
            </div>
          </div>
        
    </div>
    <form method="GET" action="{{url('/admin/mylea/post-treatment/stock-card')}}">
        @csrf
        <div class="row mb-3 ">
            <label for="Warna" class="col-sm-2 col-form-label col-form-label-sm">Warna :</label>
            <div class="col-sm-2">
                <select name="Warna" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="Original">Original</option>
                    <option value="Black">Black</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="Grade" class="col-sm-2 col-form-label col-form-label-sm">Grade :</label>
            <div class="col-sm-2">
                <select name="Grade" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="A">A</option>
                    <option value="E">E</option>
                </select>     
            </div>
        </div>
        <div class="row mb-3">
            <label for="Ukuran" class="col-sm-2 col-form-label col-form-label-sm">Ukuran :</label>
            <div class="col-sm-2">
                <select name="Ukuran" class="form-control form-control-sm" id="colFormLabelSm">
                        <option value="20x20">20x20</option>
                        <option value="22x28">22x28</option>
                        <option value="22x32">22x32</option>
                        <option value="<20x20">&#60 20x20</option>
                        <option value="GradeC">Grade C</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="KategoriReinforce" class=" col-sm-2 col-form-label col-form-label-sm">Kategori Reinforce :</label>
            <div class="col-sm-2">
                <select name="KategoriReinforce" class="form-control form-control-sm" id="colFormLabelSm">
                    <option value="Reinforce">Reinforce</option>
                    <option value="Tidak di Reinforce">Tidak di Reinforce</option>
                </select>
            </div>
        </div>
        <input type="submit" value="Lihat Data" name="search" class="btn btn-primary float-auto" id="submit">
</form>
@if(isset($FilteredData))
<div class="container m-2">
  <div class="row">
      <div class="col-md-8" style="float: left; display:inline-block;">
          <h2>
            Total In Stock : {{$Jumlah}}
          </h2>
      </div>
      <div class="col-md-4 " style="float: right;">
          <button class="btn btn-primary" id="export" onclick="generate()">Export as .docx</button>
      </div>
  </div>
</div>
<table class="table">
    <tr>
        <th>Kode Produksi</th>
        <th>Warna</th>
        <th>Grade</th>
        <th>Ukuran</th>
        <th>Kategori Reinforce</th>
        <th>Jumlah</th>
        <th>In Stock</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    @foreach ($grup as $key => $item)
        <tr>
            <td>{{$key}}</td>
            <td>{{$_GET['Warna']}}</td>
            <td>{{$_GET['Grade']}}</td>
            <td>{{$_GET['Ukuran']}}</td>
            <td>{{$_GET['KategoriReinforce']}}</td>
            <td>{{$item['Jumlah']}}</td>
            <td>{{$item['Jumlah'] - $item['Terpakai']}}</td>
            <td><a href="{{route('FormPemakaian', ['id'=>$key,])}}">Pemakaian</a></td>
            <td><a href="{{route('DataPemakaian', ['id'=>$key,])}}">Data Pemakaian</a></td>
            <td><a href="{{route('DeleteStock', ['id'=>$key,])}}">Delete</a></td>
        </tr>
    @endforeach

    <script src="https://unpkg.com/docx@7.7.0/build/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>

    @include('admin.mylea.PostTreatment.JS.ExportDataJS')
@endif
</section>

@endsection