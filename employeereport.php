<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <title>SFMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap.bundle.min.js"></script>

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

<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-sm-3">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="employeereport.php">EMPLOYEE REPORT</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="studentreport.php">STUDENT REPORT</a>
        </li>	        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="paymentmodelreport.php">PAYMENTMODEL REPORT</a>
        </li>
		 <li class='divider'></li>
		<li class='divider'></li>
		        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="paymentreport.php">STUDENT PAYMENT REPORT</a>
        </li>
		 <li class='divider'></li>
      </ul>
      <hr class="d-sm-none">
    </div>
	
	<!---end side menu-->
    <div class="col-sm-9">
   
   
   
   
<?php

echo"
	
	<div class='admin_body'>
	<div class='row'>

<div class='table-responsive'>          
  <table class='table'>
    <thead>

      <tr>
        <th>#</th>
		<th>EMPLOYEENAME</th>
		<th>EMPLOYEEIDNO</th>
		<th>EMPLOYEEPHONE</th>
		<th>EMPLOYEEPOSITION</th>
		
      </tr>
	  
    </thead>
    <tbody>";
	if(isset($_POST['searchemployee'])){
	$employeecode=$_POST["employeecode"];
	$sql="SELECT `EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_photo`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password`,`position_id`, `position_name` FROM `employee_tb` INNER JOIN `position_tb` ON `position_id`=`EMPLOYEE_position` WHERE `EMPLOYEE_fname` LIKE '%$employeecode%' OR `EMPLOYEE_lname` LIKE '%$employeecode%'";
	}else{
		
			$sql="SELECT `EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_photo`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password`,`position_id`, `position_name` FROM `employee_tb` INNER JOIN `position_tb` ON `position_id`=`EMPLOYEE_position`";
		
	}
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$EMPLOYEE_id=$row["EMPLOYEE_id"];
$EMPLOYEE_name=$row["EMPLOYEE_fname"]."".$row["EMPLOYEE_lname"];
$EMPLOYEE_idno=$row["EMPLOYEE_idno"];
$EMPLOYEE_phone=$row["EMPLOYEE_phone"];
$position_name=$row["position_name"];

$no=$no+1;

			
	echo"
      <tr>
        <td>$no</td>
		<td>$EMPLOYEE_name</td>
		<td>$EMPLOYEE_idno</td>
		<td>$EMPLOYEE_phone</td>
		<td>$position_name</td></tr>
	 ";
	  }
	  echo "	
      <tr>
        <td></td>
        <td></td>
        <td><a href='report_employee.php'  target='_blank'><button type='button' class='btn btn-info'>PRINTREPORT</button></a></td></tr>
	 ";
	  
	  }else{
			echo"<tr>
        <td colspan='5'>
      NO EMPLOYEE FOUND.</td>
      
	  </tr>
	 ";  
	  }
	  
    echo "
	</tbody>
  </table>
  </div></div></div>
	
	";

?>

	  
    </div>
  </div>
</div>

<div class="mt-5 p-4 bg-dark text-white text-center fixed-bottom">
  <p>Footer</p>
</div>

</body>
</html>
