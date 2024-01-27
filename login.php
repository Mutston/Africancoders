<?php
session_start();


include('db.php');

if(isset($_POST['login'])){
	$username=$_POST["username"];
	$pswd=$_POST["pswd"];
	$sql="SELECT `EMPLOYEE_id`, `EMPLOYEE_fname`, `EMPLOYEE_lname`, `EMPLOYEE_position`, `EMPLOYEE_username`, `EMPLOYEE_password` FROM `employee_tb` where `EMPLOYEE_username`='$username' AND `EMPLOYEE_password`='$pswd'";
	$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
  if($row = mysqli_fetch_array($result)) {
	  		$_SESSION["uid"]=$row["EMPLOYEE_id"];
	$_SESSION["fname"]=$row["EMPLOYEE_fname"]."".$row["EMPLOYEE_lname"];

	  
	header('location:dashboard.php');
}
}else{
	
$error=1;
		header("location:login.php?error=$error");
}

}



if(isset($_POST['studentlogin'])){
	$username=$_POST["username"];
	$pswd=$_POST["pswd"];
	$sql="SELECT`student_id`,`student_reg`, `student_username`, `student_pass`, `student_fname` FROM `student_tb` WHERE `student_username`='$username' AND `student_pass`='$pswd'";
	$result=mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
  if($row = mysqli_fetch_array($result)) {
	  		$_SESSION["stdid"]=$row["student_id"];
	$_SESSION["stdname"]=$row["student_fname"]."-".$row["student_reg"];

	  
	header('location:studentdashboard.php');
}
}else{
	
$error=2;
		header("location:login.php?error=$error");
}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>STUDENT FNANCIAL MANAGENT SYSTEM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">SFSM</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>STUDENT FINANCIAL MANAGEMENT SYSTEM</h1>
          <h2>Better Solution for student payment</h2>
         
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
		
        <div class="row"> 

    <div class="col-sm-12">
	<?php 
	if(isset($_GET["error"])){
		$result=$_GET["error"];
		if($result==1){
			echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>User Not Found</strong>
  </div>";
		}elseif($result==2){
				echo"<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    <strong>Student Not Found </strong></div>";
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

    <div class="col-sm-12">
		  <form action="login.php" method="POST">
  <div class="mb-3 mt-3">
    <label for="username" class="form-label"><h1>UserName:</h1></label>
    <input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label"><h1>Password:</h1></label>
    <input type="password" class="form-control" id="upwd" placeholder="Enter password" name="pswd" required>
  </div>
  <div class="btn-group">
   <div class="d-flex justify-content-center justify-content-lg-start">
            <button type="submit" name="login" class="btn-get-started scrollto">LOGIN</button>
          </div>
		  
		  <div class="d-flex justify-content-center justify-content-lg-start">
            <button type="submit" name="studentlogin" class="btn-get-started scrollto">LOGIN AS STUDENT</button>
          </div> </div>
</form>
	 </div>
	 </div>
	 
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container footer-bottom clearfix">
  
      <div class="credits">
      
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
