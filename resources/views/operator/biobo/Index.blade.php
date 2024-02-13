@extends('layouts.operator')

@section('content')
<section class="body m-5 align-center" style="height: 60vh; display: d-block;">
    <script>
        window.onload = function() {

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
                name: "Produksi Biobo",
                dataPoints: [
                <?php
                 foreach($BioboProduction as $data3){
                     $Tanggal = $data3['TanggalPanen'];
                     $Tahun = substr($Tanggal, 0, 4);
                     $Bulan = substr($Tanggal, 5, 2)-1;
                     $Hari = substr($Tanggal, 8, 2);
                ?>     
                    { x:new Date(<?php echo $Tahun.", ".$Bulan.", ".$Hari?>), y: <?php echo $data3['Jumlah'];?> },
                <?php
                 }
                ?>
                ]
            }]
        });
        chart2.render();
        }
    </script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div class="mx-auto m-5">
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
    </div>
</section>

<div id="TaskList" class="m-5 mx-auto col-md-4 align-middle">
    <h4>Today Task List</h4>
    <div style="height: auto; border: 1px; border-color:rgb(119, 119, 119); border-style: dotted;">
        <div class="m-2">
            <h6>Biobo</h6>
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

<section class="mx-auto col-md-3 align-middle" style="height: 40vh;">
    <!-- <a href="{{url('/operator/biobo/harvest')}}" class="list-group-item list-group-item-action">Biobo Harvesting</a><br> -->
    <a href="{{url('/operator/biobo/post-treatment-1')}}" class="list-group-item list-group-item-action">Biobo Post Treatment 1</a><br>
    <a href="{{url('/operator/biobo/post-treatment-2')}}" class="list-group-item list-group-item-action">Biobo Post Treatment 2</a><br>
</section>
@endsection