<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
$sql="SELECT `student_id`, `student_reg`, `student_fname`, `student_lname`, `student_phone`, `student_idno`, `student_photo`, `student_fees`, `student_lastpymt`, `student_totpaid`, `student_lastpydate`, `student_username`, `student_pass`, `student_academicyear`, (`student_fees`-`student_totpaid`) as unpaifees FROM `student_tb` order by `student_id` desc limit 1";
		
	$run_query=mysqli_query($conn,$sql);
	$newstudent_reg="STD/1";
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$student_id=$row["student_id"];
$newstudent_reg="STD/".$row["student_id"]+1;}}



	if(isset($_POST['addnewstudent'])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$phone=$_POST["phone"];
	$idno=$_POST["idno"];
	$academicyear=$_POST["academicyear"];
	$academicyear_fees=$_POST["academicyearfees"];
	$username=$_POST["username"];
	$pass=$_POST["pass"];
		$phoneval=is_numeric($phone);
	$idnoval=is_numeric($idno);
		$phoneva2=strlen($phone);
		$idnova2=strlen($idno);
		
	 if(($phoneval==1) AND ($idnoval==1)AND ($phoneva2==10)AND ($idnova2==16)){
		 
	$sql="SELECT `student_id` FROM `student_tb` order by `student_id` desc limit 1";
		
	$run_query=mysqli_query($conn,$sql);
	$newstudent_reg="STD/1";
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$student_id=$row["student_id"];
$newstudent_reg="STD/".$row["student_id"]+1;}}
	
	
	$sql="INSERT INTO `student_tb`(`student_reg`, `student_fname`, `student_lname`, `student_phone`, `student_idno`,`student_username`, `student_pass`, `student_academicyear`, `student_fees`) VALUES
	('$newstudent_reg','$fname','$lname','$phone','$idno','$username','$pass','$academicyear','$academicyear_fees')";
if(mysqli_query($conn,$sql)){
	$error=1;
		header("location:addnewstudent.php?error=$error");
	 }}else if(($phoneval=="")OR ($phoneva2<10)){	
	$error=2;
	header("location:addnewstudent.php?error=$error");
	}else if(($idnoval=="")OR($idnova2<16)){	
	$error=3;
		header("location:addnewstudent.php?error=$error");
	}else{
		 
		 $error=4;
		header("location:addnewstudent.php?error=$error");
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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="addnewstudent.php">ADD NEW</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewstudent.php">VIEW</a>
        </li>
		<li class='divider'></li>
		        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="studentpayment.php">Student-Payments</a>
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
    <strong>Student SuccessFully Inserted! </strong></div>";
		}elseif($result==2){
			echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Telephone Must Be Number Only And 10 Digital</strong>
  </div>";
		}elseif($result==3){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>IDNo Must Be Number Only AND 16 Digital </strong></div>";
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
	 <?PHP 	$sql="SELECT `academic_year_id`, `academic_year_name`, `academic_year_fees`, `academic_year_status` FROM `academic_year_tb` WHERE academic_year_status='open'";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	
	?>
	 
    <div class="col-sm-6">
  <form action="addnewstudent.php" method="POST">
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
	  <div class="mb-3">
      <label for="pwd">STUDENTCODE</label>
      <input type="text" class="form-control" id="stdcode" name="stdcode" value='<?php echo $newstudent_reg;?>' disabled>
    </div> 
    <div class="mb-3 mt-3">
      <label for="email">ACADEMIC_YEAR</label>
      <select class="form-select" id="academicyear" name="academicyear">
     
	  
	  <?php
	  
	  	$sql="SELECT `academic_year_id`, `academic_year_name`, `academic_year_fees`, `academic_year_status` FROM `academic_year_tb` WHERE academic_year_status='open'";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$academic_year_id=$row["academic_year_id"];
$academic_year_name=$row["academic_year_name"];
 echo"<option value='$academic_year_name'>$academic_year_name</option>";
}}
	  ?>
    </select> 
    </div>
	 <div class="mb-3 mt-3">
      <label for="email">ACADEMIC_YEAR_fees</label>
      <select class="form-select" id="academicyearfees" name="academicyearfees">
     
	  
	  <?php
	  
	  	$sql="SELECT `academic_year_id`, `academic_year_name`, `academic_year_fees`, `academic_year_status` FROM `academic_year_tb` WHERE academic_year_status='open'";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$academic_year_id=$row["academic_year_id"];
$academic_year_fees=$row["academic_year_fees"];
 echo"<option value='$academic_year_fees'>$academic_year_fees</option>";
}}
	  ?>
    </select> 
    </div>
    <div class="mb-3">
      <label for="pwd">USERNAME</label>
      <input type="text" class="form-control" id="username" placeholder="Enter balance" name="username" required>
    </div>
	  <div class="mb-3">
      <label for="pwd">PASSWORD</label>
      <input type="text" class="form-control" id="pass" placeholder="Enter balance" name="pass" required>
    </div>
    <button type="submit" name='addnewstudent' class="btn btn-primary">REGISTER</button>
  </form>
     </div>
  
<?php
}else{
	echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>No Academic year Open,Open Academic year And Try Again</strong></div>";
	
}

?>
    </div>
	  
    </div>
  </div>
</div>


</body>
</html>
