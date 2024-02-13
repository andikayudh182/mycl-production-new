@extends('layouts.operator')

@section('content')
<div class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo') }}">Biobo</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/operator/biobo/post-treatment-2') }}">Monitoring Post Treatment 2</a></li>
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
            <th>Proses Sanding</th>
            <th>Proses Cutting</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($PT2 as $data)
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
            @if($data['Tanggal'] == null)
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FormTerima{{$data['id']}}">
                    Terima
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="FormTerima{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Terima Biobo {{$data['NoBatch']}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="{{ url('/operator/biobo/post-treatment-2/terima', ['id'=>$data['id'],])}}" class="m-5">
                            <div class="row mb-3 ">
                                <label for="Tanggal" class="col-sm-2 col-form-label col-form-label-sm">Tanggal:</label>
                                <div class="col-sm-5">
                                    <input type="hidden" value="{{$data['id']}}" name="id"/>
                                    <input type="date"  name="Tanggal" value="{{$data['Tanggal']}}" class="form-control form-control-sm  @error('Tanggal') is-invalid @enderror" id="colFormLabelSm">
                                    @error('Tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </td>
            @else
            <td>{{$data['Tanggal']}}</td>
            @endif
            <td>{{$data['U10x15']}}</td>
            <td>{{$data['U10x20']}}</td>
            <td>{{$data['U30x30']}}</td>
            @if ($data['TanggalSanding'] == null)
            <td>Belum Dikerjakan</td>
            @else
            <td>{{$data['TanggalSanding']}}</td>    
            @endif
            @if ($data['TanggalCutting'] == null)
            <td>Belum Dikerjakan</td>
            @else
            <td>{{$data['TanggalCutting']}}</td>    
            @endif
            <td><a href="{{url('/operator/biobo/monitoring-post-treatment-2/FormSanding', ['id'=>$data['id'], 'NoBatch'=>$data['NoBatch'],])}}">Sanding</a></td>
            <td><a href="{{url('/operator/biobo/monitoring-post-treatment-2/FormCutting', ['id'=>$data['id'], 'NoBatch'=>$data['NoBatch'],])}}">Cutting</a></td>
        </tr>
        @endforeach
    </table>
</section>
@endsection