@extends('layouts.operator')

@section('content')
<section class="body m-5 align-middle" style="height: 60vh; display: d-block;">
    <?php
    $JumlahBaglog = '0';
    $Kontaminasi = '0';
    foreach ($MyleaProduction as $data) {
         $JumlahBaglog = $JumlahBaglog + $data['JumlahBaglog'];
         foreach($MyleaKonta as $data2){
             if($data2['KodeProduksi'] == $data['KodeProduksi']){
                 $Kontaminasi = $Kontaminasi + $data2['Jumlah'];
             }
         }
    }
    if($JumlahBaglog == '0'){
        $PersenKonta = '0';
    }
    else {
        $PersenKonta = $Kontaminasi/$JumlahBaglog*100;
    }
    ?>
    <?php
    $dataPoints = array( 
        array("label"=>"Hasil Baglog", "y"=> 100-$PersenKonta),
        array("label"=>"Kontaminasi", "y"=> $PersenKonta),
    )
     
    ?>

    <script>
        window.onload = function() {
        
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Produksi Baglog"
            },
            subtitles: [{
                text: "<?php echo date('M-Y');?>"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK);?>
            }]
        });

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Data Produksi"
            },
            subtitles: [{
                text: "<?php echo date('M-Y');?>"
            }],
            axisX: {
                valueFormatString: "MMM YYYY"
            },
            data: [{        
                type: "line",
                indexLabelFontSize: 16,
                axisYType: "secondary",
                name: "Produksi Baglog",
                dataPoints: [
                <?php
                 foreach($MyleaProduction as $data3){
                     $Tanggal = $data3['TanggalProduksi'];
                     $Tahun = substr($Tanggal, 0, 4);
                     $Bulan = substr($Tanggal, 5, 2)-1;
                     $Hari = substr($Tanggal, 8, 2);
                ?>     
                    { x:new Date(<?php echo $Tahun.", ".$Bulan.", ".$Hari?>), y: <?php echo $data3['JumlahBaglog'];?> },
                <?php
                 }
                ?>
                ]
            }]
        });
        chart.render();
        chart2.render();
        }
    </script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div class="mx-auto">
        <div id="chartContainer" style="height: 370px; width: 47.5%; display: inline-block;"></div>
        <div id="chartContainer2" style="height: 370px; width: 47.5%; display: inline-block;"></div>
    </div>
</section>

<div id="TaskList" class="m-5 mx-auto col-md-6 align-middle">
    <h4>Today Task List</h4>
    <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
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
</div>

<section class="mx-auto col-md-3 align-middle" style="height: 40vh;">
    <a href="{{url('/operator/mylea/produksi-mylea')}}" class="list-group-item list-group-item-action">Produksi Mylea</a><br>
    <a href="{{url('/operator/mylea/production-report')}}" class="list-group-item list-group-item-action">Production Report</a><br>
    <a href="{{url('/operator/mylea/post-treatment')}}" class="list-group-item list-group-item-action">Produksi Post Treatment Mylea</a><br>
</section>
@endsection