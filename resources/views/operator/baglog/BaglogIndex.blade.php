@extends('layouts.operator')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/operator_dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Baglog</li>
        </ol>
    </nav>
</section>

<section class="body m-5 align-middle" style="height: 60vh; display: d-block;">
    <?php
    $JumlahBaglog = '0';
    $Kontaminasi = '0';
    foreach ($chart as $data) {
         $JumlahBaglog = $JumlahBaglog + $data['JumlahBaglog'];
         foreach($kontaminasi as $data2){
             if($data2['KodeProduksi'] == $data['KodeProduksi']){
                 $Kontaminasi = $Kontaminasi + $data2['JumlahKontaminasi'];
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
                 foreach($chart as $data3){
                     $Tanggal = $data3['TanggalPembibitan'];
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

<div id="TaskList" class="m-5 mx-auto col-md-3 align-middle">
    <h4>Today Task List</h4>
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
</div>

<section class="mx-auto col-md-3 align-middle" style="height: 40vh;">
    <a href="{{ url('operator/baglog/produksi-baglog-1') }}" class="list-group-item list-group-item-action">Tahap 1 Produksi Baglog</a><br>
    <a href="{{ url('operator/baglog/pembibitan') }}" class="list-group-item list-group-item-action">Pembibitan</a><br>
    <a href="{{ url('operator/baglog/qcbaglog') }}" class="list-group-item list-group-item-action">QC Baglog</a><br>
</section>


@endsection