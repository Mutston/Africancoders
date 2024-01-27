
<?php
if($_GET["menu_deleteid"]){
	include("db.php");
	$menudelete=$_GET["menu_deleteid"];
	
	$sql="DELETE FROM `employee_roles_tb` WHERE `employee_roles_id`='$menudelete'";
	if(mysqli_query($conn,$sql)){
	header('location:addemployeemenu.php');
}
}
?>