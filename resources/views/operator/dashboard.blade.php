@extends('layouts.operator')

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
                                                
                                                foreach($kartukendali as $data){
                                                    if($data['TanggalPembibitan'] == $day){
                                                        $Jumlah = $Jumlah + $data['JumlahBaglog'];
                                                    }
                                                }
                                            }
                                    ?>
                                            { label: <?php echo $x;?>, y: 0 },

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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
