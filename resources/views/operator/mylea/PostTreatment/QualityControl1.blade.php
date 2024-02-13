@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea') }}">Mylea</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/mylea/post-treatment') }}">Post Treatment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quality Control 1</li>
        </ol>
    </nav>
</section>

<section class="m-5">
    <form method="POST" action="{{ url('/operator/mylea/post-treatment/qc1-submit') }}">
        @csrf
        <div class="row mb-3 ">
            <label for="ArrivalDate" class="col-sm-2 col-form-label col-form-label-sm">Arrival Date :</label>
            <div class="col-sm-5">
                <input type="date" name="ArrivalDate" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <div class="row mb-3 ">
            <label for="KodeMylea" class="col-sm-2 col-form-label col-form-label-sm">Kode Produksi Mylea :</label>
            <div class="col-sm-5">
                <select name="KodeMylea" class="form-control select2-single" id="KodeMylea" style="width:100%; background-color: #f8fafc;>
                    @foreach ($Mylea as $key => $item)
                        @if(!($item['GradeA'] == 0 & $item['GradeE'] == 0)){
                            <option value="{{$item['KodeProduksi'].','.$item['JenisPanen']}}">{{$item['KodeProduksi']}}, {{$item['JenisPanen']}}, Grade A : {{$item['GradeA']}}, Grade E : {{$item['GradeE']}}</option>   
                        }
                        @endif
                    @endforeach    
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="GradeA" class="col-sm-2 col-form-label col-form-label-sm">Grade A :</label>
            <div class="col-sm-5">
                <input type="text" name="GradeA" class="form-control form-control-sm" id="GradeA">
            </div>
        </div>
        <div class="row mb-3">
            <label for="GradeE" class="col-sm-2 col-form-label col-form-label-sm">Grade E :</label>
            <div class="col-sm-5">
                <input type="number" name="GradeE" class="form-control form-control-sm" id="colFormLabelSm">
            </div>
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-primary float-auto" id="submit">
    </form>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script>
    $("#KodeMylea").select2({
        theme: "bootstrap4"
    });
</script>
@endsection