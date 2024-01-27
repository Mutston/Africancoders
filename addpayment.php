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
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="addnewpaymentmodel.php">ADD NEW PaymentModel</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewpaymentmodel.php">VIEW PaymentModel</a>
        </li>	        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="addpayment.php">ADD NEW PAYMENT</a>
        </li>
		 <li class='divider'></li>
		<li class='divider'></li>
		        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewpayment.php">ViewPayments</a>
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
      <th colspan='6'>  
	     <form action='addpayment.php' method='POST'>
    <div class='mb-3 mt-3'>
       <input type='text' class='form-control' placeholder='Enter STUDENT CODE' name='stdcode'>  </th>
  <th><button type='submit' name='searchstudent' class='btn btn-primary'>Save</button>  </div>
  </form><th>
		
      </tr>
      <tr>
        <th>#</th>
		<th>STUDENTCODE</th>
		<th>STUDENTNAME</th>
		<th>STUDENTIDNO</th>
		<th>STUDENTPHONE</th>
		<th>STUDENTYEAR</th>
		<th>STUDENTUNPAIDFEES</th>
		
      </tr>
	  
    </thead>
    <tbody>";
	if(isset($_POST['searchstudent'])){
	$studentcode=$_POST["stdcode"];
	$sql="SELECT `student_id`, `student_reg`, `student_fname`, `student_lname`, `student_phone`, `student_idno`, `student_photo`, `student_fees`, `student_lastpymt`, `student_totpaid`, `student_lastpydate`, `student_username`, `student_pass`, `student_academicyear`, (`student_fees`-`student_totpaid`) as unpaifees FROM `student_tb` WHERE `student_reg`='$studentcode'";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$student_id=$row["student_id"];
$student_reg=$row["student_reg"];
$student_name=$row["student_fname"]."".$row["student_lname"];
$student_idno=$row["student_idno"];
$student_phone=$row["student_phone"];
$student_academicyear=$row["student_academicyear"];
$student_unpaifees=$row["unpaifees"];

$no=$no+1;

			
	echo"
      <tr>
        <td>$no</td>
		<td>$student_reg</td>
		<td>$student_name</td>
		<td>$student_idno</td>
		<td>$student_phone</td>
		<td>$student_academicyear</td>
		<td>$student_unpaifees</td>
		
	 <td><a href='studentnewpayment.php?id=$student_id'  class='btn btn-primary' ><span class='glyphicon glyphicon-ok-sign'>Edit</span></a></td>
	  </tr>
	 ";
	  }}else{
			echo"<tr>
        <td colspan='5'>
      NO STUDENT FOUND.</td>
      
	  </tr>
	 ";  
	  }
	  
    echo "
	</tbody>
  </table>
  </div></div></div>
	
	";}

?>



    </div>
  </div>
</div>



</body>
</html>
