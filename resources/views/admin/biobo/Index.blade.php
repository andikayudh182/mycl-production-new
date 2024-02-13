@extends('layouts.admin')

@section('content')
<section class="m-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/admin_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produksi Biobo</li>
        </ol>
    </nav>
</section>

<section class="body m-5 align-center" style="height: 80vh; display: d-block;">
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
                     $Tanggal = $data3['TanggalProduksi'];
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

<section class="mx-auto col-md-3 align-middle" style="height: 80vh;">
    <a href="{{url('/admin/biobo/harvest')}}" class="list-group-item list-group-item-action">Biobo Harvesting</a><br>
    <a href="{{url('/admin/biobo/pt1')}}" class="list-group-item list-group-item-action">Monitoring</a><br>
    <!--
    <a href="{{url('/admin/biobo/pt2')}}" class="list-group-item list-group-item-action">Biobo Post Treatment 2</a><br>
    -->
</section>
@endsection
