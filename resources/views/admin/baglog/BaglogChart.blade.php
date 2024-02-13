<?php
 
$dataPoints1 = array(
	array("label"=> "January", "y"=> $Data['DataPoint'][1]),
	array("label"=> "February", "y"=> $Data['DataPoint'][2]),
	array("label"=> "March", "y"=> $Data['DataPoint'][3]),
	array("label"=> "April", "y"=> $Data['DataPoint'][4]),
	array("label"=> "May", "y"=> $Data['DataPoint'][5]),
	array("label"=> "June", "y"=> $Data['DataPoint'][6]),
	array("label"=> "July", "y"=> $Data['DataPoint'][7]),
	array("label"=> "August", "y"=> $Data['DataPoint'][8]),
	array("label"=> "September", "y"=> $Data['DataPoint'][9]),
	array("label"=> "October", "y"=> $Data['DataPoint'][10]),
	array("label"=> "November", "y"=> $Data['DataPoint'][11]),
    array("label"=> "December", "y"=> $Data['DataPoint'][12]),
);

$dataPoints2 = array(
	array("label"=> "January", "y"=> $Data['DataPoint2'][1]),
	array("label"=> "February", "y"=> $Data['DataPoint2'][2]),
	array("label"=> "March", "y"=> $Data['DataPoint2'][3]),
	array("label"=> "April", "y"=> $Data['DataPoint2'][4]),
	array("label"=> "May", "y"=> $Data['DataPoint2'][5]),
	array("label"=> "June", "y"=> $Data['DataPoint2'][6]),
	array("label"=> "July", "y"=> $Data['DataPoint2'][7]),
	array("label"=> "August", "y"=> $Data['DataPoint2'][8]),
	array("label"=> "September", "y"=> $Data['DataPoint2'][9]),
	array("label"=> "October", "y"=> $Data['DataPoint2'][10]),
	array("label"=> "November", "y"=> $Data['DataPoint2'][11]),
    array("label"=> "December", "y"=> $Data['DataPoint2'][12]),
);
 
 
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer3", {
	title: {
		text: "Produksi Baglog"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: true,
		reversed: true
	},
	axisY: {
		title: "Jumlah Baglog",
		suffix: ""
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "stackedColumn",
			name: "Produksi Baglog",
			showInLegend: true,
			yValueFormatString: "#",
			indexLabel: "{y}",
			indexLabelFontColor: "#5A5757",
			indexLabelPlacement: "outside",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},
        {
			type: "line",
			name: "Kontaminasi",
			showInLegend: true,
			yValueFormatString: "#",
			indexLabel: "{y}",
			indexLabelFontColor: "#fffff",
			indexLabelPlacement: "outside",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		},
	]
});
 
chart.render();
 
function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  