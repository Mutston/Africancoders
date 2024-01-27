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
   
   
    <div class="col-sm-3">
	 </div>
    <div class="col-sm-6">
  <form action="addnewfaculte.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="email">FACULTENAME</label>
      <input type="text" class="form-control" id="facultename" placeholder="Enter Name" name="facultename" required>
    </div>
    <button type="submit" name='savefaculte' class="btn btn-primary">Save</button>
  </form>
  
  <p>
    <p>
     </div>
	  
    <div class="col-sm-3">
	 </div>
	  
    </div>
  </div>
</div>

<div class="mt-5 p-4 bg-dark text-white text-center fixed-bottom">
  <p>Footer</p>
</div>

</body>
</html>
<?php


if(isset($_POST['savefaculte'])){
	$facultename=$_POST["facultename"];
	$sql="INSERT INTO `faculte_tb`(`faculte_name`) VALUES ('$facultename')";
	if(mysqli_query($conn,$sql)){
	header('location:viewfaculte.php');
}
	}

?>