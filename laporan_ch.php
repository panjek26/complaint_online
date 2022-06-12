<!DOCTYPE html>
<html lang="en">

<?php
$init='LPR';
$sub_init='HLPR';
include ('header.php'); 
include ('session.php');
$fungsi= new Fungsi();
?>
<style>
#chartdiv {
  width: 600px;
  height: 300px;
}	
#chartbtg {
  width: 100%;
  height: 500px;
}											
</style>

<script src="bower_components/jquery/dist/amcharts.js"></script>
<script src="bower_components/jquery/dist/pie.js"></script>
<script src="bower_components/jquery/dist/serial.js"></script>
<script src="bower_components/jquery/dist/light.js"></script>

<body>

    <div id="wrapper">

        <!-- Side Menu -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

<?php include ('nav_header.php'); // sub header?> 

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
<?php include ('side_menu.php') // menu?>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">				
                    <div class="panel panel-default">
                        <h3 class="page-header">Chart Complaint</h3>
						
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="filter">
								<form method="post" id="sample_form">							
                                    <table>
									<tr>
									<td width="100px"> <label>Start Month</label></td>
									<td width="10px">:</td>
									<td width="250px">
										<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm" data-link-field="dtp_input2" data-link-format="yyyy-mm">
										<input type="text" class="form-control" required name="startdate" value="<?php echo $_POST['startdate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div>
									</td>
									<td width="70px"></td>
									<td width="100px"> <input type="submit" class="btn btn-primary btn-block" name="filter" value="Filter" /></td>
									<td width="10px"></td>
									<td width="250px">
									</td>
									<td width="50px"></td>
									<td></td>
									</tr>
									<tr height="50px">
									<td>  <label>End Month</label></td>
									<td>:</td>
									<td><div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm" data-link-field="dtp_input2" data-link-format="yyyy-mm">
										<input type="text" class="form-control" required required name="enddate" value="<?php echo $_POST['enddate'] ?>">
										<span class="add-on"><i class="icon-th"></i></span>
										</div></form></td>
									<td></td>
									<td width="100px">								
									</td>
									<td></td>
									<td> </td>
									<td></td>
									<td>
									
      
                                    

									</td>
									</tr>
									
									<tr height="40px"></tr>
									</table>
									<!-- pie chart -->	
<?php
if($_POST['filter']){		

$startdate	=$_POST['startdate']."-01";
$endate		=$_POST['enddate']."-31 23:59:59";
if($startdate>$endate){
	echo "<script>alert('START MONTH TIDAK BOLEH LEBIH BESAR DARI END MONTH'); location.href='laporan_ch.php'</script>";
	}
$sla	=$fungsi->get_sla($startdate,$endate);
$graph	=$fungsi->get_grafik($startdate,$endate);
$row	=mysql_fetch_array($sla);
$tampil	="";
$arrData	= array();

while($Data=mysql_fetch_array($graph)){
$arrData[$Data['period']."ttl"]=$Data['ttl'];
$arrData[$Data['period']."cl"]=$Data['cl'];
$arrData[$Data['period']."sla"]=$Data['sla'];
}
/*
while($gr=mysql_fetch_array($graph)){
	$tampil .="{ 'date': '".$gr['period']."',
        'Complaint': ".$gr['ttl'].",
        'Close': ".$gr['cl'].",
        'Sla': ".$gr['sla']."
    },";
}*/
		$month = strtotime($startdate."-01");
while($month < strtotime($endate."-01")) {
		$prd=date('Y-m', $month);
		$tampil .="{ 'date': '".$prd."',
        'Complaint': ".number_format($arrData[$prd."ttl"],0).",
        'Close': ".number_format($arrData[$prd."cl"],0).",
        'Sla': ".number_format($arrData[$prd."sla"],0)."
    },";
		$month = strtotime("+1 month", $month);
		}
?>							
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "dataProvider": [ {
    "sla": "YES",
    "value": <?php echo $row['yes']; ?>
  }, {
    "sla": "NO",
    "value": <?php echo $row['_no'];  ?>
  } ],
  "valueField": "value",
  "titleField": "sla",
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": false
  }
} );
</script>
<?php if(is_null($row['ttl'])){ } else {?>
						<div class="col-md-8">	
							<div class="panel panel-default">
								<div class="panel-heading">
									Pie Chart Layanan SLA Maintenance PT. ALBANI CORONA LESTARI
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
										<div id="chartdiv"></div>
								</div>
								<!-- /.panel-body -->
							</div>						
						</div>
								<!-- End pie chart -->	
<?php } ?>								
								<!-- Grafik -->	

	<script>
var chart = AmCharts.makeChart("chartbtg", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "equalWidths": false,
        "useGraphSettings": true,
        "valueAlign": "left",
        "valueWidth": 120
    },
    "dataProvider": [<?php echo substr($tampil,0,-1) ?>],
    "graphs": [{
        "alphaField": "alpha",
        "balloonText": "[[value]] Complaint",
        "dashLengthField": "dashLength",
        "fillAlphas": 0.7,
        "legendPeriodValueText": "total: [[value.sum]]",
        "legendValueText": "[[value]]",
        "title": "Complaint",
        "type": "column",
        "valueField": "Complaint",
        "valueAxis": "distanceAxis"
    }, {
        "balloonText": "Close:[[value]]",
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "useLineColorForBulletBorder": true,
        "bulletColor": "#FFFFFF",
        "bulletSizeField": "townSize",
        "dashLengthField": "dashLength",
        "descriptionField": "townName",
        "labelPosition": "right",
        "labelText": "[[townName2]]",
        "legendValueText": "[[value]]",
        "title": "Close",
        "fillAlphas": 0,
        "valueField": "Close",
        "valueAxis": "ComplaintAxis"
    }, {
        "balloonText": "Sla:[[value]]",
        "bullet": "square",
        "bulletBorderAlpha": 1,
        "bulletBorderThickness": 1,
        "dashLengthField": "dashLength",
        "legendValueText": "[[value]]",
        "title": "Sla",
        "fillAlphas": 0,
        "valueField": "Sla",
        "valueAxis": "SlaAxis"
    }],
    "chartCursor": {
        "categoryBalloonDateFormat": "MM",
        "cursorAlpha": 0.1,
        "cursorColor":"#000000",
         "fullWidth":true,
        "valueBalloonsEnabled": false,
        "zoomable": false
    },
    "dataDateFormat": "YYYY-MM",
    "categoryField": "date",
    "categoryAxis": {
        "dateFormats": [{
            "period": "MM",
            "format": "MM"
        }, {
            "period": "WW",
            "format": "MMM DD"
        }, {
            "period": "MM",
            "format": "MMM"
        }, {
            "period": "YYYY",
            "format": "YYYY"
        }],
        "parseDates": false,
        "autoGridCount": false,
        "axisColor": "#555555",
        "gridAlpha": 0.1,
        "gridColor": "#FFFFFF",
        "gridCount": 50
    },
    "export": {
    	"enabled": true
     }
});
</script>
							
						<div class="col-md-12">	
							<div class="panel panel-default">
								<div class="panel-heading">
									Grafik Complaint ACL
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
										<div id="chartbtg"></div>
								</div>
								<!-- /.panel-body -->
							</div>						
						</div>
								<!-- grafik -->	
<?php } ?>

                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include ('jquery.php'); ?>
<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>

</body>

</html>
