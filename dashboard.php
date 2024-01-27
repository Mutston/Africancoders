<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SFMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap.bundle.min.js"></script>
  
  
  
  
<?php


$sql="SELECT `PAYMENTMODEL_id`, `PAYMENTMODEL_name`, `PAYMENTMODEL_amount` FROM `paymentmodel_tb`";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while ($row = mysqli_fetch_assoc($run_query)) {
$dataPoints[] = array("label"=> $row['PAYMENTMODEL_name'] , "y"=> $row['PAYMENTMODEL_amount'] );
}}


?>


<script>

window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "ACCOUNT BALANCE"
	},
	subtitles: [{
		text: "Currency Used: Rwandan francs (Rwf)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		//indexLabel: "{label} - #percent%",
	indexLabel: "{label} - {y}",
		yValueFormatString: "Rwf#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});



chart.render();
}  </script>

</head>
<body>

<div class="p-1 bg-primary text-white text-center">
  <h1>STUDENT FINANCIALS INFORMATION MANAGEMENT SYSTEM</h1>
  <p>Administration Panel</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
  <?php
  include('dynamicmenu.php');
  ?>
	
<ul class="nav navbar-nav navbar-right" style="padding-right:50px;">
<li><a href="#"  style="color:white;text-decoration: none;"><?php echo "Hi,".$_SESSION['fname'];?></a>
<li><a href="index.php" style="text-decoration:none; color:white;">::Logout</a></li>
</li>
</ul>

  </div>
</nav>

<div class="container mt-2">
  <div class="row">
    <div class="col-sm-3">
    
    </div>
	
	<!---end side menu-->
    <div class="col-sm-9">
   
   <div id="get_data">


<div id="chartContainer1" style="height: 370px; width: 100%;"></div>





</div>
	  
    </div>
  </div>
</div>

<div class="mt-5 p-4 bg-dark text-white text-center">
  <p>Footer</p>
</div>
<script src="js/canvasjs.min.js"></script>
<script type="text/javascript" src="charts/loader.js"></script>
<script type="text/javascript" src="chartjs/Chart.min.js"></script>
</body>
</html>
