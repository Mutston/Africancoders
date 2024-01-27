<?php
session_start();

include('db.php');
if(!isset($_SESSION["stdid"])){
	header("location:index.php");
}


if(isset($_POST['updatestudent'])){
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$phone=$_POST["phone"];
	$idno=$_POST["idno"];
	$academicyear=$_POST["academicyear"];
	$username=$_POST["username"];
	$pass=$_POST["pass"];
		$studentup_id=$_POST["studentup_id"];
		
		$phoneval=is_numeric($phone);
	$idnoval=is_numeric($idno);
		$phoneva2=strlen($phone);
		$idnova2=strlen($idno);
		
	 if(($phoneval==1) AND ($idnoval==1)AND ($phoneva2==10)AND ($idnova2==16)){
		 
	$sql="UPDATE `student_tb` SET  `student_fname`='$fname', `student_lname`='$lname', `student_phone`='$phone', `student_idno`='$idno',`student_username`='$username', `student_pass`='$pass', `student_academicyear`='$academicyear' WHERE `student_id`='$studentup_id'";
if(mysqli_query($conn,$sql)){
	$error=1;
	header("location:studentupdatemyinfo.php?id=$studentup_id&error=$error");
}
	 }else if(($phoneval=="")OR ($phoneva2<10)){	
	$error=2;
	header("location:studentupdatemyinfo.php?id=$studentup_id&error=$error");
	}else if(($idnoval=="")OR($idnova2<16)){	
	$error=3;
	header("location:studentupdatemyinfo.php?id=$studentup_id&error=$error");
	}else{
		 
		 $error=4;
	header("location:studentupdatemyinfo.php?id=$studentup_id&error=$error");
	 }




	}else{
$stid=$_GET["id"];
$sql="SELECT `student_id`, `student_reg`, `student_fname`, `student_lname`, `student_phone`, `student_idno`, `student_photo`, `student_fees`, `student_lastpymt`, `student_totpaid`, `student_lastpydate`, `student_username`, `student_pass`, `student_academicyear`, (`student_fees`-`student_totpaid`) as unpaifees FROM `student_tb` WHERE `student_id`='$stid'";
		
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$student_id=$row["student_id"];
$student_reg=$row["student_reg"];
$student_fname=$row["student_fname"];
$student_lname=$row["student_lname"];
$student_phone=$row["student_phone"];
$student_idno=$row["student_idno"];
$student_username=$row["student_username"];
$student_pass=$row["student_pass"];
$student_academicyear=$row["student_academicyear"];


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
    <ul class="navbar-nav">
  
  
      <li class='nav-item'>
        <a class='nav-link' href='mystudent.php'>STUDENTS</a>
      </li><li class='nav-item'>
        <a class='nav-link' href='payment.php'>PAYMENTS</a>
</li>
  </ul>
	<ul class="nav navbar-nav navbar-right" style="padding-right:50px;">
<li><a href="#"  style="color:white;text-decoration: none;"><?php echo "Hi,".$_SESSION['stdname'];?></a>
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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewmyinformation.php">MyInformation</a>
        </li>
		<li class='divider'></li>
		        <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="mypayment.php">MyPayments</a>
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
    <strong>Student SuccessFully Updated! </strong></div>";
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
    <div class="col-sm-6">
  <form action="studentupdatemyinfo.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">FIRSTNAME</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value='<?php echo $student_fname;?>' >
    </div>
    <div class="mb-3">
      <label for="pwd">LASTNAME</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter LastName" name="lname" value='<?php echo $student_lname;?>' >
    </div>
	  <div class="mb-3">
      <label for="pwd">PHONE</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value='<?php echo $student_phone;?>' maxlength='10'>
    </div>
	  <div class="mb-3">
      <label for="pwd">IDNO</label>
      <input type="text" class="form-control" id="idno" placeholder="Enter IDNo" name="idno" value='<?php echo $student_idno;?>' maxlength='16'>
    </div>  
     </div>
	  <div class="col-sm-6">
	  <div class="mb-3">
      <label for="pwd">STUDENTCODE</label>
      <input type="text" class="form-control" id="stdcode" name="stdcode" value='<?php echo $student_reg;?>' disabled>
    </div> 
    <div class="mb-3 mt-3">
      <label for="email">ACADEMIC_YEAR</label>
      <input type="text" class="form-control" id="academicyear" placeholder="Enter academicyear" name="academicyear" value='<?php echo $student_academicyear;?>' >
    </div>
    <div class="mb-3">
      <label for="pwd">USERNAME</label>
      <input type="text" class="form-control" id="username" placeholder="Enter balance" name="username" value='<?php echo $student_username;?>' >
    </div>
	  <div class="mb-3">
      <label for="pwd">PASSWORD</label>
      <input type="text" class="form-control" id="pass" placeholder="Enter balance" name="pass" value='<?php echo $student_pass;?>' >
      <input type="hidden" class="form-control" id="pass"  name="studentup_id" value='<?php echo $student_id;?>' >
    </div>
    <button type="submit" name='updatestudent' class="btn btn-primary">UPDATE</button>
  </form>
     </div>
  
  
    </div>
	  
    </div>
  </div>
</div>


</body>
</html>
<?php
	}

	

?>