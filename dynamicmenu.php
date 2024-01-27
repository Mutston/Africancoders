  <ul class="navbar-nav">
     
  
<?php
$currrent_user_id=$_SESSION["uid"];
 $sql="SELECT `employee_roles_id`, `employee_roles_role`, `employee_roles_employee` FROM `employee_roles_tb`  WHERE `employee_roles_employee`='$currrent_user_id' order by `employee_roles_role`";
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
while($row=mysqli_fetch_array($run_query)){
$menu_number=$row["employee_roles_role"];
if($menu_number==1){
echo"<li class='nav-item' style='border:1px solid #f0f0f0;padding: 6px 11px;'>
        <a class='nav-link active' href='dashboard.php'>DASHBOARD</a>
      </li>";}
if($menu_number==2){
echo"<li class='nav-item'>
        <a class='nav-link' href='employee.php'>EMPLOYEES</a>
      </li>";}

if($menu_number==3){
echo"<li class='nav-item'>
        <a class='nav-link' href='faculte.php'>FACULTES</a>
      </li>";}

if($menu_number==4){
echo" <li class='nav-item'>
        <a class='nav-link' href='option.php'>OPTIONS</a>
      </li>";}
if($menu_number==5){
echo"
      <li class='nav-item'>
        <a class='nav-link' href='student.php'>STUDENTS</a>
      </li>";}
if($menu_number==6){
echo" <li class='nav-item'>
        <a class='nav-link' href='payment.php'>PAYMENTS</a>
</li>";}

if($menu_number==7){
echo" <li class='nav-item'>
        <a class='nav-link' href='report.php'>REPORTS</a>
</li>";}
}

}?>  
</ul>