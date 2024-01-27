<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_POST['savestudentpaid'])){
	$date=date("Y-m-d");
	$pymodelid=$_POST["pymodelid"];
	$studentid=$_POST["studentid"];
	$stdunpaid=$_POST["stdunpaid"];
	$stdnewpaid=$_POST["stdnewpaid"];
	if($stdnewpaid>$stdunpaid){
		header('location:studentpaymenterror.php');
	}else{
	$sql="INSERT INTO `studentpayment_tb`(`STUDENTPAYMENT_std`, `STUDENTPAYMENT_amount`, `STUDENTPAYMENT_pydate`,`STUDENTPAYMENT_pymtmodel`) VALUES ('$studentid','$stdnewpaid','$date','$pymodelid')";
if(mysqli_query($conn,$sql)){
	$sql="UPDATE `paymentmodel_tb` SET `PAYMENTMODEL_amount`=`PAYMENTMODEL_amount`+ $stdnewpaid WHERE `PAYMENTMODEL_id`='$pymodelid'";
if(mysqli_query($conn,$sql)){
	$sql="UPDATE `student_tb` SET `student_lastpymt`='$stdnewpaid',`student_totpaid`=`student_totpaid`+$stdnewpaid,`student_lastpydate`='$date' WHERE `student_id`='$studentid'";
	if(mysqli_query($conn,$sql)){
	header('location:viewpayment.php');}
	}}}
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
$student_academicyear=$row["student_academicyear"];
$student_unpaifees=$row["unpaifees"];


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
   
	
     <div class="row">
    <div class="col-sm-6">
  <form action="studentnewpayment.php" method="POST">
    <div class="mb-3 mt-3">
	
      <input type="hidden" class="form-control" id="studentid" name="studentid" value='<?php echo $student_id;?>'>
      <label for="email">FIRSTNAME</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value='<?php echo $student_fname;?>' disabled>
    </div>
    <div class="mb-3">
      <label for="pwd">LASTNAME</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter LastName" name="lname" value='<?php echo $student_lname;?>' disabled>
    </div>
	  <div class="mb-3">
      <label for="pwd">PHONE</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value='<?php echo $student_phone;?>' maxlength='10' disabled>
    </div>
	  <div class="mb-3">
      <label for="pwd">IDNO</label>
      <input type="text" class="form-control" id="idno" placeholder="Enter IDNo" name="idno" value='<?php echo $student_idno;?>' maxlength='16' disabled>
    </div>  
	    <div class="mb-3 mt-3">
      <label for="email">ACADEMIC_YEAR</label>
      <input type="text" class="form-control" id="academicyear" placeholder="Enter academicyear" name="academicyear" value='<?php echo $student_academicyear;?>'  disabled>
    </div>
     </div>
	  <div class="col-sm-6">
	  <div class="mb-3">
      <label for="pwd">STUDENTCODE</label>
      <input type="text" class="form-control" id="stdcode" name="stdcode" value='<?php echo $student_reg;?>' disabled>
    </div> 

    <div class="mb-3">
      <label for="pwd">UNPAIDFEES</label>
      <input type="text" class="form-control"  value='<?php echo $student_unpaifees;?>' disabled>
      <input type="hidden" class="form-control" id="stdunpaid" name="stdunpaid" value='<?php echo $student_unpaifees;?>'>
    </div> 
	<?php
	if($student_unpaifees<=0){}else{
	  echo"<div class='mb-3'>
      <label for='pwd'>ADD PAID AMOUNT</label>
      <input type='text' class='form-control' id='stdnewpaid' name='stdnewpaid' value='0'>
    </div> 
	   <div class='mb-3 mt-3'>
	<label for='sel1' class='form-label'>Select PaymentModel:</label>
    <select class='form-select' id='pymodelid' name='pymodelid'>";
    
	  	$sql="SELECT `PAYMENTMODEL_id`, `PAYMENTMODEL_name`, `PAYMENTMODEL_amount` FROM `paymentmodel_tb`";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {

while($row=mysqli_fetch_array($run_query)){
$PAYMENTMODEL_id=$row["PAYMENTMODEL_id"];
$PAYMENTMODEL_name=$row["PAYMENTMODEL_name"];
 echo"<option value='$PAYMENTMODEL_id'>$PAYMENTMODEL_name</option>";
}}
    echo"</select> </div>
    <button type='submit' name='savestudentpaid' class='btn btn-primary'>PAY</button>";}
	?>
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