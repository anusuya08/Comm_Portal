<?php
   if(isset($_SESSION["role"]))
   {
	   if($_SESSION["role"] == "admin" || $_SESSION["role"] == "superadmin")
	   {
?>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<div class="w3-bar w3-black w3-large">
		  <img src="http://localhost/www/public/images/logo.png" align="left" style="width:55px; height:45px">
		  <a href="/www/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
		  <a href="/www/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
		  <a href="/www/public/modules/user/userlistadmin.php" class="w3-bar-item w3-button w3-mobile">Administer Users</a>
		  <a href="/www/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
		  <a href="/www/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout (<?php echo $_SESSION['role'];?>)</a>
		</div>
<?php 
		} else
		{
?>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<div class="w3-bar w3-black w3-large">
		  <img src="http://localhost/www/public/images/logo.png" align="left" style="width:55px; height:45px">
		  <a href="/www/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
		  <a href="/www/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
		  <a href="/www/public/modules/user/userlist.php" class="w3-bar-item w3-button w3-mobile">View Users</a>
		  <a href="/www/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a> 
		  <a href="/www/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout(<?php echo $_SESSION['role'];?>)</a>
		</div>
<?php 
		}
   } else
   {
?>
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<div class="w3-bar w3-black w3-large">
			  <img src="http://localhost/www/public/images/logo.png" align="left" style="width:55px; height:45px">
			  <a href="/www/public/home.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>Home</a>
			  <a href="/www/public/aboutus.php" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-bed w3-margin-right"></i>About Us</a>
			  <a href="/www/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
			  <a href="/www/public/login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Login</a>
			</div>
<?php 
   } 
?>