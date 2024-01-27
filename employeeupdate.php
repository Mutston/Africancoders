<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_POST['updateemployee'])){
	$empid=$_POST["empid"];
		$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$phone=$_POST["phone"];
	$idno=$_POST["idno"];
	$facultid=$_POST["facultid"];
	$positionid=$_POST["positionid"];
	$username=$_POST["username"];
	$pass=$_POST["pass"];
	
		$phoneval=is_numeric($phone);
	$idnoval=is_numeric($idno);
		$phoneva2=strlen($phone);
		$idnova2=strlen($idno);

	 if(($phoneval==1) AND ($idnoval==1)AND ($phoneva2==10)AND ($idnova2==16)AND ($positionid>0)AND ($facultid>0)){
	
	
$sql="UPDATE `employee_tb` SET `EMPLOYEE_fname`='$fname', `EMPLOYEE_lname`='$lname', `EMPLOYEE_idno`='$idno', `EMPLOYEE_phone`='$phone', `EMPLOYEE_position`='$positionid', `EMPLOYEE_faculte`='$facultid', `EMPLOYEE_username`='$username', `EMPLOYEE_password`='$pass' WHERE `EMPLOYEE_id`='$empid'";
if(mysqli_query($conn,$sql)){
	
		$error=6;
		header("location:employeeupdate.php?id=$empid&error=$error");
	 }}else if(($phoneval=="")OR ($phoneva2<10)){	
		$error=1;
		header("location:employeeupdate.php?id=$empid&error=$error");
	}else if(($idnoval=="")OR($idnova2<16)){	
		$error=2;
		header("location:employeeupdate.php?id=$empid&error=$error");
	}else if($positionid<=0){	
		$error=3;
		header("location:employeeupdate.php?id=$empid&error=$error");
	}else if($facultid<=0){	
		$error=4;
		header("location:employeeupdate.php?id=$empid&error=$error");
	}else{
		$error=5;
		header("location:employeeupdate.php?id=$empid&error=$error");
	}
	}else{
$employeeid=$_GET["id"];
$sql="SELECT `EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_photo`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password`, `position_name`, `faculte_name` FROM `employee_tb` INNER JOIN `position_tb` ON `position_id`=`EMPLOYEE_position` INNER JOIN `faculte_tb` ON `faculte_id`=`EMPLOYEE_faculte` WHERE `EMPLOYEE_id`='$employeeid'";
		
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
while($row=mysqli_fetch_array($run_query)){
$EMPLOYEE_id=$row["EMPLOYEE_id"];
$EMPLOYEE_fname=$row["EMPLOYEE_fname"];
$EMPLOYEE_lname=$row["EMPLOYEE_lname"];
$EMPLOYEE_idno=$row["EMPLOYEE_idno"];
$EMPLOYEE_phone=$row["EMPLOYEE_phone"];
$EMPLOYEE_photo=$row["EMPLOYEE_photo"];
$EMPLOYEE_position=$row["EMPLOYEE_position"];
$EMPLOYEE_positionname=$row["position_name"];
$EMPLOYEE_faculte=$row["EMPLOYEE_faculte"];
$EMPLOYEE_facultename=$row["faculte_name"];
$EMPLOYEE_username=$row["EMPLOYEE_username"];
$EMPLOYEE_password=$row["EMPLOYEE_password"];


}}

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

    <div class="col-sm-12">
	<?php 
	if(isset($_GET["error"])){
		$result=$_GET["error"];
		if($result==1){
			echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Telephone Must Be Number Only And 10 Digital</strong>
  </div>";
		}elseif($result==2){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>IDNo Must Be Number Only AND 16 Digital </strong></div>";
		}elseif($result==3){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Position Must Be Selected </strong></div>";
		}elseif($result==4){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Faculte Must Be Selected </strong></div>";
		}elseif($result==5){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>All Box Must Be Filled,Check Again </strong></div>";
		}elseif($result==6){
				echo"<div class='alert alert-success alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Employee SuccessFully Updated! </strong></div>";
		}else{
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong> </strong></div>";
		}
	}
	
	?>
	 </div>
	 </div>
        <div class="row">
    <div class="col-sm-6">
  <form action="employeeupdate.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">FIRSTNAME</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value="<?php echo $EMPLOYEE_fname;?>" required>
       <input type="hidden" class="form-control" id="empid"  name="empid" value="<?php echo $employeeid;?>">
     </div>
    <div class="mb-3">
      <label for="pwd">LASTNAME</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter LastName" name="lname"  value="<?php echo $EMPLOYEE_lname;?>" required>
    </div>
	  <div class="mb-3">
      <label for="pwd">PHONE</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone"  maxlength='10' value="<?php echo $EMPLOYEE_phone;?>"  required>
    </div>
	  <div class="mb-3">
      <label for="pwd">IDNO</label>
      <input type="text" class="form-control" id="idno" placeholder="Enter IDNo" name="idno"  maxlength='16'  value="<?php echo $EMPLOYEE_idno;?>" required>
    </div>  
     </div>
	  <div class="col-sm-6">
	   <div class="mb-3 mt-3">
	<label for="sel1" class="form-label">Select Faculte:</label>
    <select class="form-select" id="facultid" name="facultid">
     
	  
	  <?php

	  	$sql="SELECT `faculte_id`, `faculte_name` FROM `faculte_tb`";
	$run_query=mysqli_query($conn,$sql);
	 echo"<option value='$EMPLOYEE_faculte'>$EMPLOYEE_facultename</option>";
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$faculte_id=$row["faculte_id"];
$faculte_name=$row["faculte_name"];
 echo"<option value='$faculte_id'>$faculte_name</option>";
}}
	  ?>
    </select> </div>
   <div class="mb-3 mt-3">
	<label for="sel1" class="form-label">Select Position:</label>
    <select class="form-select" id="positionid" name="positionid">
     
	  
	  <?php
	  
	  	$sql="SELECT `position_id`, `position_name` FROM `position_tb` where `position_id`>1";
	$run_query=mysqli_query($conn,$sql);
	 echo"<option value='$EMPLOYEE_position'>$EMPLOYEE_positionname</option>";
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$position_id=$row["position_id"];
$position_name=$row["position_name"];
 echo"<option value='$position_id'>$position_name</option>";
}}
	  ?>
    </select> </div>
    <div class="mb-3">
      <label for="pwd">USERNAME</label>
      <input type="text" class="form-control" id="username" placeholder="Enter balance" name="username"  value="<?php echo $EMPLOYEE_username;?>" required>
    </div>
	  <div class="mb-3">
      <label for="pwd">PASSWORD</label>
      <input type="text" class="form-control" id="pass" placeholder="Enter balance" name="pass"  value="<?php echo $EMPLOYEE_password;?>" required>
    </div>
    <button type="submit" name='updateemployee' class="btn btn-primary">UPDATE</button>
  </form>
     </div>
  
  
    </div>
	  
    </div>
  </div>
</div>

<div class="bg-dark text-white text-center fixed-bottom">
  <p> </p>
</div>

</body>
</html>

<?php
	}

?>