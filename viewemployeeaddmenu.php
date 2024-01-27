<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}



if(isset($_POST['saveempmenu'])){
	$empid=$_POST["empid"];
	$menuid=$_POST["menuid"];
	if($empid<=0){
		echo '<script type="text/JavaScript">  
     
	 alert("Please Select Employee");
     </script>';
	 header('location:addemployeemenu.php');
	}elseif($menuid<=0){
		echo '<script type="text/JavaScript">  
     
	 alert("Please Select Role");
     </script>';
	 header('location:addemployeemenu.php');
	}else{
		
	
	$sql="INSERT INTO `employee_roles_tb`(`employee_roles_role`, `employee_roles_employee`) VALUES ('$menuid','$empid')";
	if(mysqli_query($conn,$sql)){
	header('location:addemployeemenu.php');
}}
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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="addnewemployee.php">ADD NEW</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewemployee.php">VIEW</a>
        </li>
		<li class='divider'></li>
		 
		     <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="addemployeemenu.php">MENU</a>
        </li>
		<li class='divider'></li>
      </ul>
      <hr class="d-sm-none">
    </div>
	
	<!---end side menu-->
    <div class="col-sm-9">

	 <div class="row">
    <div class="col-sm-6">
  <form action="viewemployeeaddmenu.php" method="POST">
 <div class="mb-3 mt-3">
	<label for="sel1" class="form-label">Select Employee:</label>
    <select class="form-select" id="empid" name="empid">
     
	  
	  <?php
	  
$emp=$_GET["id"];
	  	$sql="SELECT `EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_photo`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password` FROM `employee_tb` where `EMPLOYEE_id`='$emp'";
	$run_query=mysqli_query($conn,$sql);
 echo"<option value='0'>Select Employee</option>";
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$EMPLOYEE_id=$row["EMPLOYEE_id"];
$employee_name=$row["EMPLOYEE_fname"]."".$row["EMPLOYEE_lname"];
 echo"<option value='$EMPLOYEE_id'>$employee_name</option>";
}}
	  ?>
    </select> </div>
 <div class="mb-3 mt-3">
	<label for="sel1" class="form-label">Select Menu:</label>
    <select class="form-select" id="menuid" name="menuid">
     
	  
	  <?php
	  
	 $sql="SELECT `role_id`, `role_name` FROM `role_tb` WHERE `role_id` NOT IN (SELECT `employee_roles_role` FROM `employee_roles_tb`  WHERE `employee_roles_employee`='$emp')";
	$run_query=mysqli_query($conn,$sql);
	
 echo"<option value='0'>Select Menu</option>";
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$role_id=$row["role_id"];
$role_name=$row["role_name"];
 echo"<option value='$role_id'>$role_name</option>";
}}
	  ?>
    </select> </div>
	
    <button type="submit" name='saveempmenu' class="btn btn-primary">AddMenu</button>
  </form>
  
  <p>
    <p>
     </div>
 <div class="col-sm-6">
     </div>
	  </div>
	 <div class="row">
	 <?php
echo"
<div class='row'>

<div class='table-responsive'>          
  <table class='table'>
    <thead>
	
      <tr>
        <th>#</th>
		<th>MENU_NAME</th>
		<th></th>
      </tr>
    </thead>
    <tbody>";
	$sql="SELECT `role_id`, `role_name`,`employee_roles_id` FROM `role_tb` INNER JOIN `employee_roles_tb`  ON `role_id`=`employee_roles_role`  WHERE `employee_roles_employee`='$emp'";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){

$menuuser_roleID=$row["employee_roles_id"];
$menu_name=$row["role_name"];

$no=$no+1;

			
	echo"
      <tr>
        <td>$no</td>
        <td>$menu_name</td>
		<td><a href='deletemenu.php?menu_deleteid=$menuuser_roleID' class='btn btn-danger'><span class='glyphicon glyphicon-ok-sign'>Delete</span></a></td>
	
	  </tr>
	 ";
	  }}else{
			echo"<tr>
        <td colspan='5'>
      NO  Role ASSIGNED.</td>
      
	  </tr>
	 ";  
	  }
	  
    echo "
	</tbody>
  </table>
  </div></div>
 ";?>
</div>	 
	  
    </div>
  </div>
</div>

<div class="bg-dark text-white text-center fixed-bottom">
  <p> </p>
</div>

</body>
</html>
	 