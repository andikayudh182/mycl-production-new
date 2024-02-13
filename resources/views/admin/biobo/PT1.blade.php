@extends('layouts.admin')

@section('content')
    <section class="m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/biobo')}}">Produksi Biobo</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biobo Post Treament 1 Data</li>
            </ol>
        </nav>
    </section>

    <section class="m-5">
        <h3>Data Post Treament 1 Biobo</h3>
        <table class="table">
            <tr>
                <th>No Batch</th>
                <th>Tanggal Terima</th>
                <th>10x15</th>
                <th>10x20</th>
                <th>30x30</th>
                <th>Proses Terakhir</th>
                <th>Post Treatment 1</th>
                <th>Post Treatment 2</th>
            </th>
            @foreach ($Data as $data)
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
                <td><?php echo $data['Tanggal']?></td>
                <td><?php echo $data['U10x15']?></td>
                <td><?php echo $data['U10x20']?></td>
                <td><?php echo $data['U30x30']?></td>
                <td>
                    @if(isset($data['TanggalCutting']) && isset($data['TanggalSanding']) && isset($data['TanggalPressing']) && isset($data['TanggalDrying']))
                        Selesai
                    @elseif(isset($data['TanggalSanding']) && isset($data['TanggalPressing']) && isset($data['TanggalDrying']))
                        Menunggu proses cutting
                    @elseif(isset($data['TanggalPressing']) && isset($data['TanggalDrying']))
                        Menunggu proses sanding
                    @elseif(isset($data['TanggalDrying']))
                        Menunggu proses pressing
                    @else
                        Menunggu proses drying
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target={{"#PT1".$data['id']}}>
                        PT1
                    </button>
                    @include('admin.biobo.MonitoringModals')
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target={{"#PT2".$data['id']}}>
                        PT2
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {!! $Data->links() !!}
        </div>
    </section>
@endsection