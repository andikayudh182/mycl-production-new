@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo') }}">Biobo</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo/post-treatment-1') }}">Post Treatment 1</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
        </ol>
    </nav>
</div>

<section class="m-5">
    <table class="table">
        <tr>
            <th>No Batch</th>
            <th>Tanggal</th>
            <th>10x15</th>
            <th>10x20</th>
            <th>30x30</th>
            <th>Proses Drying</th>
            <th>Proses Pressing</th>
        </tr>
        @foreach ($PT1 as $data)
        <tr>
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target={{"#exampleModal".$data['id']}}>
                    <?php echo $data['NoBatch']?>
                </button>
                <div class="modal fade" id="{{"exampleModal".$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{$data['NoBatch']}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <th>Tanggal Panen</th>
                                    <th>Kode Produksi Mylea</th>
                                    <th>Jumlah</th>
                                </tr>
                                @foreach($data['Mylea'] as $item)
                                    <tr>
                                        <td>{{$item['TanggalPanen']}}</td>
                                        <td>{{$item['TanggalProduksi']}}</td>
                                        <td>{{$item['jumlah']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                </div>
            </td>
            <td>{{$data['Tanggal']}}</td>
            <td>{{$data['U10x15']}}</td>
            <td>{{$data['U10x20']}}</td>
            <td>{{$data['U30x30']}}</td>
            @if ($data['TanggalDrying'] == null)
            <td>Belum Dikerjakan</td>
            @else
            <td>{{$data['TanggalDrying']}}</td>    
            @endif
            @if ($data['TanggalPressing'] == null)
            <td>Belum Dikerjakan</td>
            @else
            <td>{{$data['TanggalPressing']}}</td>    
            @endif
            <td><a href="{{url('/operator/biobo/monitoring-post-treatment-1/FormDrying', ['id'=>$data['id'], 'NoBatch'=>$data['NoBatch'],])}}">Drying</a></td>
            <td><a href="{{url('/operator/biobo/monitoring-post-treatment-1/FormPressing', ['id'=>$data['id'], 'NoBatch'=>$data['NoBatch'],])}}">Pressing</a></td>
        </tr>
        @endforeach
    </table>
</section>
@endsection