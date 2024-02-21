@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <script>
                       window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            title: {
                                text: "Data Produksi"
                            },
                            axisX: {
                                valueFormatString: "",
                            },
                            axisY2: {
                                title: "Total Produksi per Minggu",
                                prefix: "",
                                suffix: ""
                            },
                            toolTip: {
                                shared: true
                            },
                            legend: {
                                cursor: "pointer",
                                verticalAlign: "top",
                                horizontalAlign: "center",
                                dockInsidePlotArea: true,
                                itemclick: toogleDataSeries
                            },
                            data: [{
                                type:"line",
                                axisYType: "secondary",
                                name: "Baglog",
                                showInLegend: true,
                                markerSize: 0,
                                xValueFormatString: "Minggu ke-#",
                                yValueFormatString: "",
                                dataPoints: [
                                    <?php
                                        $ThisYear = date("Y");
                                        $start = new DateTime('01.01.'.$ThisYear);
                                        $end = new DateTime('31.12.'.$ThisYear.' 23:59');
                                        $interval = new DateInterval('P1D');
                                        $dateRange = new DatePeriod($start, $interval, $end);

                                        $weekNumber = 1;
                                        $weeks = [];
                                        foreach ($dateRange as $date) {
                                            $weeks[$weekNumber][] = $date->format('Y-m-d');
                                            if ($date->format('w') == 0) {
                                                $weekNumber++;
                                            }
                                        }
                                        $datapoints = array();
                                        $x = 1;
                                        foreach($weeks as $week){
                                            $Jumlah = '0';

                                            foreach ($week as $day){
                                                
                                                foreach($kartukendali as $data){
                                                    if($data['TanggalPembibitan'] == $day){
                                                        $Jumlah = $Jumlah + $data['JumlahBaglog'];
                                                    }
                                                }
                                            }
                                    ?>
                                            { label: <?php echo $x;?>, y: <?php echo $Jumlah;?> },

                                    <?php
                                            $x++;
                                        }
                                    ?>		
                                ]
                            },
                            {
                                type:"line",
                                axisYType: "secondary",
                                name: "Mylea",
                                showInLegend: true,
                                markerSize: 0,
                                labelValueFormatString: "Minggu ke-#",
                                yValueFormatString: "",
                                dataPoints: [
                                    <?php
                                        $ThisYear = date("Y");
                                        $start = new DateTime('01.01.'.$ThisYear);
                                        $end = new DateTime('31.12.'.$ThisYear.' 23:59');
                                        $interval = new DateInterval('P1D');
                                        $dateRange = new DatePeriod($start, $interval, $end);

                                        $weekNumber = 1;
                                        $weeks = [];
                                        foreach ($dateRange as $date) {
                                            $weeks[$weekNumber][] = $date->format('Y-m-d');
                                            if ($date->format('w') == 0) {
                                                $weekNumber++;
                                            }
                                        }
                                        $datapoints = array();
                                        $x = 1;
                                        foreach($weeks as $week){
                                            $Jumlah = '0';

                                            foreach ($week as $day){
                                                
                                                foreach($MyleaProduction as $data){
                                                    if($data['TanggalProduksi'] == $day){
                                                        $Jumlah = $Jumlah + $data['JumlahBaglog'];
                                                    }
                                                }
                                            }
                                    ?>
                                            { label: <?php echo $x;?>, y: <?php echo $Jumlah;?> },

                                    <?php
                                            $x++;
                                        }
                                    ?>		
                                ]
                            },
                            {
                                type:"line",
                                axisYType: "secondary",
                                name: "Post Treatment Mylea",
                                showInLegend: true,
                                markerSize: 0,
                                labelValueFormatString: "Minggu ke-#",
                                yValueFormatString: "",
                                dataPoints: [
                                    <?php
                                        $ThisYear = date("Y");
                                        $start = new DateTime('01.01.'.$ThisYear);
                                        $end = new DateTime('31.12.'.$ThisYear.' 23:59');
                                        $interval = new DateInterval('P1D');
                                        $dateRange = new DatePeriod($start, $interval, $end);

                                        $weekNumber = 1;
                                        $weeks = [];
                                        foreach ($dateRange as $date) {
                                            $weeks[$weekNumber][] = $date->format('Y-m-d');
                                            if ($date->format('w') == 0) {
                                                $weekNumber++;
                                            }
                                        }
                                        $datapoints = array();
                                        $x = 1;
                                        foreach($weeks as $week){
                                            $Jumlah = '0';

                                            foreach ($week as $day){
                                                
                                                foreach($PostTreatment as $data){
                                                    if($data['FinishDate'] == $day){
                                                        $Jumlah = $Jumlah + $data['Jumlah'];
                                                    }
                                                }
                                            }
                                    ?>
                                            { label: <?php echo $x;?>, y: <?php echo $Jumlah;?> },

                                    <?php
                                            $x++;
                                        }
                                    ?>		
                                ]
                            },
                            {
                                type:"line",
                                axisYType: "secondary",
                                name: "Biobo",
                                showInLegend: true,
                                markerSize: 0,
                                labelValueFormatString: "Minggu ke-#",
                                yValueFormatString: "",
                                dataPoints: [
                                    <?php
                                        $ThisYear = date("Y");
                                        $start = new DateTime('01.01.'.$ThisYear);
                                        $end = new DateTime('31.12.'.$ThisYear.' 23:59');
                                        $interval = new DateInterval('P1D');
                                        $dateRange = new DatePeriod($start, $interval, $end);

                                        $weekNumber = 1;
                                        $weeks = [];
                                        foreach ($dateRange as $date) {
                                            $weeks[$weekNumber][] = $date->format('Y-m-d');
                                            if ($date->format('w') == 0) {
                                                $weekNumber++;
                                            }
                                        }
                                        $datapoints = array();
                                        $x = 1;
                                        foreach($weeks as $week){
                                            $Jumlah = '0';

                                            foreach ($week as $day){
                                                
                                                foreach($BioboProduction as $data){
                                                    if($data['TanggalProduksi'] == $day){
                                                        $Jumlah = $Jumlah + $data['Jumlah'];
                                                    }
                                                }
                                            }
                                    ?>
                                            { label: <?php echo $x;?>, y: <?php echo $Jumlah;?> },

                                    <?php
                                            $x++;
                                        }
                                    ?>		
                                ]
                            },
                            ]
                        });
                        chart.render();

                        function toogleDataSeries(e){
                            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            } else{
                                e.dataSeries.visible = true;
                            }
                            chart.render();
                        }

                        }
                    </script>
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                    <div id="TaskList" class="m-5">
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
                                        @if (isset($Composite))

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

                                        @endif
                            

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
                                        @if (isset($Composite))
                                            @foreach ( $Composite as $data )
                                            <tr>
                                                @if ($data['Reminder'][0]['TanggalInkubasi'] === date('2023-10-10'))
                                                <td>{{ $data['KodeProduksi'] }}</td>
                                                <td>{{ $data['Nama'] }}</td>
                                                <td>{{ $data['JumlahComposite'] }}</td>
                                                <td>{{ $data['JumlahComposite'] - $data['JumlahKontaminasi']}}</td>
                                                @endif
                                            </tr>                                            
                                            @endforeach    
                                        @endif
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
                                        @if (isset($Composite))
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
                                        @endif
       

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
                        <h5>Baglog</h5>
                        <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                            <div class="m-2">
                            <h6>Mixing</h6>
                                <table class="table">
                                    <tr>
                                        <th>No Recipe</th>
                                        <th>Status</th>
                                    </tr>
                                @foreach ( $mixing as $data)
                                    <tr>
                                        @if($data['TanggalMixing']==date('Y-m-d'))
                                        <td><?php echo $data['NoRecipe'];?></td>
                                        @if($data['Status']=='0')
                                            <td>Belum Dikerjakan</td>
                                        @else
                                            <td>Sudah Dikerjakan</td>
                                        @endif
                                        @endif
                                    </tr>
                                @endforeach    
                                </table>
                            </div>
                            <div class="m-2">
                                <h6>Inkubasi</h6>
                                    <table class="table">
                                        <tr>
                                            <th>Kode Produksi</th>
                                            <th>Proses</th>
                                            <th>In Stock</th>
                                        </tr>
                                    @foreach ( $kartukendali as $datainkubasi)
                                        <tr>
                                            @if($datainkubasi['TanggalCrushing']==date('Y-m-d'))
                                            <td><?php echo $datainkubasi['KodeProduksi'];?></td>
                                            <td>Crushing</td>
                                            <td><?php echo $datainkubasi['InStock'];?></td>
                                            @endif
                                            @if($datainkubasi['TanggalQC']==date('Y-m-d'))
                                            <td><?php echo $datainkubasi['KodeProduksi'];?></td>
                                            <td>QC</td>
                                            <td><?php echo $datainkubasi['InStock'];?></td>
                                            @endif
                                            @if($datainkubasi['TanggalHarvest']==date('Y-m-d'))
                                            <td><?php echo $datainkubasi['KodeProduksi'];?></td>
                                            <td>Harvest</td>
                                            <td><?php echo $datainkubasi['InStock'];?></td>
                                            @endif
                                        </tr>
                                    @endforeach    
                                    </table>
                            </div>
                        </div>
                        <h5>Mylea</h5>
                        <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                            <div class="m-2">
                                <h6>Order Produksi Mylea</h6>
                                    <table class="table">
                                        <tr>
                                            <th>Kode Produksi</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    @foreach ( $OrderMylea as $dataorder)
                                        <tr>
                                            @if($dataorder['TanggalProduksi']==date('Y-m-d'))
                                            <td><?php echo $dataorder['KodeProduksi'];?></td>
                                            <td><?php echo $dataorder['JumlahBaglog'];?></td>
                                            @endif
                                        </tr>
                                    @endforeach    
                                    </table>
                            </div>
                            <div class="m-2">
                                <h6>Mylea Production</h6>
                                <table class="table">
                                    <tr>
                                        <th>Kode Produksi</th>
                                        <th>Proses</th>
                                        <th>In Stock</th>
                                    </tr>
                                @foreach ( $MyleaReminder as $DataMylea)
                                    <tr>
                                        @if($DataMylea['Elus1']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>Elus 1</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($DataMylea['Elus2']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>Elus 2</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($DataMylea['Elus3']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>Elus 3</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($DataMylea['TanggalPanen']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>Panen</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($DataMylea['PanenBiobo']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>Panen Biobo</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if($DataMylea['TanggalQC']==date('Y-m-d') || $DataMylea['TanggalQC2']==date('Y-m-d'))
                                        <td><?php echo $DataMylea['KodeProduksi'];?></td>
                                        <td>QC</td>
                                        <td>
                                            @foreach($MyleaProduction as $DataJumlah)
                                                @if($DataJumlah['KodeProduksi'] == $DataMylea['KodeProduksi'])
                                                    {{$DataJumlah['InStock']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach    
                                </table>
                            </div>
                            <div class="m-2">
                                <h6>Post Treatment</h6>
                                <table class="table">
                                    <tr>
                                        <th>Kode Produksi</th>
                                        <th>Arrival Date</th>
                                        <th>Jenis Mylea</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach($QualityControl1 as $data)
                                    <tr>
                                        <td>{{$data['KodeProduksi']}}</td>
                                        <td>{{$data['ArrivalDate']}}</td>
                                        <td>{{$data['JenisMylea']}}</td>
                                        <td>{{$data['GradeA']+$data['GradeE']}}</td>
                                        <td>
                                            @if($data['Status']==NULL)
                                                Dalam Proses                
                                            @else
                                                Sudah Selesai
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <h5>Biobo</h5>
                        <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
                            <div class="m-2">
                                    <table class="table">
                                        <tr>
                                            <th>No Batch</th>
                                            <th>Proses</th>
                                        </tr>
                                    @foreach ( $BioboPT1 as $PT1)
                                        <tr>
                                            <td>{{$PT1['NoBatch']}}</td>
                                            <td>Post Treatment 1</td>
                                        </tr>
                                    @endforeach 
                                    @foreach ( $BioboPT2 as $PT2)
                                        <tr>
                                            <td>{{$PT2['NoBatch']}}</td>
                                            <td>Post Treatment 2</td>
                                        </tr>
                                    @endforeach      
                                    </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
