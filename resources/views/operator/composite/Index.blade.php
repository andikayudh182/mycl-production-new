@extends('layouts.operator')

@section('content')

<div id="TaskList" class="col-md-7 mx-auto">
    <h3>Today Task List</h3>
    <h5>Composite</h5>
    <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
        <div class="m-2">
        <h6>Buka Cetakan</h6>
                <table class="table">
                    <tr>
                        <th>Kode Composite</th>
                        <th>Jenis Composite</th>
                        <th>Jumlah Composite</th>
                        <th>In Stock</th>
                    </tr>
                    @foreach ( $Composite as $data )
                    <tr>
                        @if ($data['Reminder'][0]['TanggalBukaCetakan'] === date('Y-m-d'))
                        <td>{{ $data['KodeProduksi'] }}</td>
                        <td>{{ $data['Nama'] }}</td>
                        <td>{{ $data['JumlahComposite'] }}</td>
                        <td>{{ $data['JumlahComposite'] - $data['JumlahKontaminasi']}}</td>
                        @endif
                    </tr>                                            
                    @endforeach

                </table>
        </div>
        <div class="m-2">
        <h6>Inkubasi</h6>
                <table class="table">
                    <tr>
                        <th>Kode Composite</th>
                        <th>Jenis Composite</th>
                        <th>Jumlah Composite</th>
                        <th>In Stock</th>
                    </tr>
                    @foreach ( $Composite as $data )
                    <tr>
                        @if ($data['Reminder'][0]['TanggalInkubasi'] === date('Y-m-d'))
                        <td>{{ $data['KodeProduksi'] }}</td>
                        <td>{{ $data['Nama'] }}</td>
                        <td>{{ $data['JumlahComposite'] }}</td>
                        <td>{{ $data['JumlahComposite'] - $data['JumlahKontaminasi']}}</td>
                        @endif
                    </tr>                                            
                    @endforeach

                </table>
        </div>
        <div class="m-2">
            <h6>Panen</h6>
                <table class="table">
                    <tr>
                        <th>Kode Composite</th>
                        <th>Jenis Composite</th>
                        <th>Jumlah Composite</th>
                        <th>In Stock</th>
                    </tr>
                    @foreach ( $Composite as $data )
                    <tr>
                        @if ( $data['Reminder'][0]['TanggalPanen'] === date('Y-m-d') )
                            <td>{{ $data['KodeProduksi'] }}</td>
                            <td>{{ $data['Nama'] }}</td>
                            <td>{{ $data['JumlahComposite'] }}</td>
                            <td>{{ $data['JumlahComposite'] - $data['JumlahKontaminasi']}}</td>
                        @endif
                      
                    </tr>                                            
                    @endforeach

                </table>
        </div>
        <div class="m-2">
            <h6>Order Produksi Composite</h6>
                <table class="table">
                    <tr>
                        <th>Jumlah Baglog</th>
                        <th>Jenis Composite</th>
                        <th>Jumlah Composite</th>
                        <th>Lokasi</th>
                        <th>Baglog</th>
                    </tr>
                    @foreach ( $OrderComposite as $data )
                    <tr>
                        @if ($data['TanggalProduksi'] === date('Y-m-d'))
                        <td>{{ $data['JumlahBaglog'] }}</td>
                        <td>{{ $data['Nama'] }}</td>
                        <td>{{ $data['JumlahComposite'] }}</td>
                        <td>{{ $data['Lokasi'] }}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-controls="offcanvasRight">Data Baglog</button>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight<?php echo $data['KodeProduksi'];?>" aria-labelledby="offcanvasRightLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasRightLabel">Data Baglog Composite <?php echo $data['KodeProduksi'];?></h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    @if(isset($BaglogComposite[$data['KodeProduksi']]))
                                    @foreach ($BaglogComposite[$data['KodeProduksi']] as $baglog )
                                        <?php echo $baglog['KodeBaglog'];?> : <?php echo $baglog['Jumlah'];?> </br>
                                    @endforeach   
                                    @endif 
                                </div>
                            </div>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                </table>
        </div>
    </div>
</div>

    <section class="mx-auto col-md-3 align-middle" style="height: 40vh; margin-top:5vh;">
        <a href="{{url('/operator/composite/produksi-composite')}}" class="list-group-item list-group-item-action">Produksi Composite</a><br>
        <a href="{{url('/operator/composite/production-report')}}" class="list-group-item list-group-item-action">Production Report</a><br>
    </section>

@endsection