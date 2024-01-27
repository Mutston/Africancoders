<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

	if(isset($_POST['addnewemployee'])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$phone=$_POST["phone"];
		 $phone1=$_POST["phone"];
	$idno=$_POST["idno"];
	$facultid=$_POST["facultid"];
	$positionid=$_POST["positionid"];
	$username=$_POST["username"];
	$pass=$_POST["pass"];
	$phoneval=is_numeric($phone);
	$idnoval=is_numeric($idno);
		$phoneva2=strlen($phone1);
		$idnova2=strlen($idno);

	 if(($phoneval==1) AND ($idnoval==1)AND ($phoneva2==10)AND ($idnova2==16)AND ($positionid>0)AND ($facultid>0)){
	
$sql="INSERT INTO `employee_tb`(`EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_idno`, `EMPLOYEE_phone`, `EMPLOYEE_position`, `EMPLOYEE_faculte`, `EMPLOYEE_username`, `EMPLOYEE_password`)VALUES
	('$fname','$lname','$idno','$phone','$positionid','$facultid','$username','$pass')";
if(mysqli_query($conn,$sql)){
	
	$error=1;
		header("location:addnewemployee.php?error=$error");
}
	}else if(($phoneval=="")OR ($phoneva2<10)){	
	$error=2;
	header("location:addnewemployee.php?error=$error");
	}else if(($idnoval=="")OR($idnova2<16)){	
	$error=3;
		header("location:addnewemployee.php?error=$error");
	}else if($positionid<=0){
	$error=4;
		header("location:addnewemployee.php?error=$error");
	}else if($facultid<=0){
	$error=5;
		header("location:addnewemployee.php?error=$error");
	}else{
		
	$error=6;
		header("location:addnewemployee.php?error=$error");
	}
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
		     <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="positionlist.php">POSITIONS</a>
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
				echo"<div class='alert alert-success alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Employee SuccessFully Inserted! </strong></div>";
		}elseif($result==2){
			echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Telephone Must Be Number Only And 10 Digital</strong>
  </div>";
		}elseif($result==3){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>IDNo Must Be Number Only AND 16 Digital </strong></div>";
		}elseif($result==4){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Position Must Be Selected </strong></div>";
		}elseif($result==5){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Faculte Must Be Selected </strong></div>";
		}else{
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>All Box Must Be Filled,Check Again </strong></div>";
		}
	}
	
	?>
	 </div>
	 </div>
        <div class="row">
    <div class="col-sm-6">
  <form action="addnewemployee.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">FIRSTNAME</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" required>
    </div>
    <div class="mb-3">
      <label for="pwd">LASTNAME</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter LastName" name="lname" required>
    </div>
	  <div class="mb-3">
      <label for="pwd">PHONE</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone"  maxlength='10' required>
    </div>
	  <div class="mb-3">
      <label for="pwd">IDNO</label>
      <input type="text" class="form-control" id="idno" placeholder="Enter IDNo" name="idno"  maxlength='16' required>
    </div>  
     </div>
	  <div class="col-sm-6">
	   <div class="mb-3 mt-3">
	<label for="sel1" class="form-label">Select Faculte:</label>
    <select class="form-select" id="facultid" name="facultid">
     
	  
	  <?php
	  
	  	$sql="SELECT `faculte_id`, `faculte_name` FROM `faculte_tb`";
	$run_query=mysqli_query($conn,$sql);
	 echo"<option value='0'>None</option>";
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
      <input type="text" class="form-control" id="username" placeholder="Enter balance" name="username" required>
    </div>
	  <div class="mb-3">
      <label for="pwd">PASSWORD</label>
      <input type="text" class="form-control" id="pass" placeholder="Enter balance" name="pass" required>
    </div>
    <button type="submit" name='addnewemployee' class="btn btn-primary">REGISTER</button>
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