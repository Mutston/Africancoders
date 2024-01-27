<?php
session_start();

include('db.php');
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}


	if(isset($_POST['addnewacademicyear'])){
	$yname=$_POST["yname"];
	$fees=$_POST["fees"];
	
$sql="INSERT INTO `academic_year_tb`(`academic_year_name`, `academic_year_fees`, `academic_year_status`)VALUES('$yname','$fees','closed')";
if(mysqli_query($conn,$sql)){
	header('location:viewacademicyear.php');
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
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;' href="addnewfaculte.php">ADD NEW</a>
        </li>
		<li class='divider'></li>
              <li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewfaculte.php">VIEW</a>
        </li>
		<li class='divider'></li>   
		<li class="nav-item">
          <a class="nav-link active"  style='border:1px solid #f0f0f0;padding: 6px 11px;'  href="viewacademicyear.php">ACADEMICYEAR</a>
        </li>
		<li class='divider'></li>
      </ul>
      <hr class="d-sm-none">
    </div>
	
	<!---end side menu-->
    <div class="col-sm-9">
        <div class="row">
    <div class="col-sm-6">
  <form action="viewacademicyear.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">ACADEMIC-YEAR</label>
      <input type="text" class="form-control" id="yname" placeholder="Enter  Name" name="yname" required>
    </div>
     <div class="mb-3 mt-3">
      <label for="email">ACADEMIC-YEAR_FEES</label>
      <input type="text" class="form-control" id="fees" placeholder="Enter  Fees" name="fees" required>
    </div>
    <button type="submit" name='addnewacademicyear' class="btn btn-primary">Add</button>
  </form>
     </div>
  
  
    </div>
	  <div class="row">
	   
<?php

echo"
<div class='table-responsive'>          
  <table class='table'>
    <thead>
	
      <tr>
        <th>#</th>
		<th>ACADEMIC-YEAR</th>
		<th>FEES</th>
		
		<th>STATUS</th>
      </tr>
    </thead>
    <tbody>";
	$sql="SELECT `academic_year_id`, `academic_year_name`, `academic_year_fees`, `academic_year_status` FROM `academic_year_tb`";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$academic_year_id=$row["academic_year_id"];
$academic_year_name=$row["academic_year_name"];
$academic_year_fees=$row["academic_year_fees"];
$academic_year_status=$row["academic_year_status"];

$no=$no+1;

			
	echo"
      <tr>
        <td>$no</td>
		<td>$academic_year_name</td> 
		<td>$academic_year_fees</td> 
		<td>$academic_year_status</td>
		
	 <td><a href='updateacademicyear.php?id=$academic_year_id'  class='btn btn-primary'><span class='glyphicon glyphicon-ok-sign'>Edit</span></a></td></tr>
	 ";
	  }}else{
			echo"<tr>
        <td colspan='5'>
      NO ACADEMICYEAR FOUND.</td>
      
	  </tr>
	 ";  
	  }
	  
    echo "
	</tbody>
  </table>
  </div>
	
	";


?>
	  </div>
	  
    </div>
  </div>
</div>

<div class=" bg-dark text-white text-center fixed-bottom">
 
</div>

</body>
</html>
