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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="addnewoption.php">ADD NEW</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewoption.php">VIEW</a>
        </li>
		<li class='divider'></li>
		        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="optionstudent.php">Option-Students</a>
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
		<th>OPTIONS</th>
		<th>FACULTE</th>
		
      </tr>
    </thead>
    <tbody>";
	$sql="SELECT `option_id`, `option_name`, `option_faculte`,`faculte_id`, `faculte_name` FROM `option_tb` INNER JOIN `faculte_tb` ON `option_faculte`=`faculte_id` ";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$option_id=$row["option_id"];
$option_name=$row["option_name"];
$faculte_id=$row["faculte_id"];
$faculte_name=$row["faculte_name"];

$no=$no+1;

			
	echo"
      <tr>
        <td>$no</td>
		<td>$option_name</td>
		<td>$faculte_name</td>
		
	 <td><a href='updateoption.php?id=$option_id'  class='btn btn-primary'><span class='glyphicon glyphicon-ok-sign'>Edit</span></a></td>
	  </tr>
	 ";
	  }}else{
			echo"<tr>
        <td colspan='5'>
      NO OPTION FOUND.</td>
      
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