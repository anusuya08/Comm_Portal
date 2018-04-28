<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;
use classes\util\Config;
require_once 'includes/password.php'; 
require_once 'includes/autoload.php';

include 'includes/header.php';
$formerror="";

$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();


if(isset($_POST["submitted"])){
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
	if ($password == $cpassword){
		if(isset($_SESSION['email'])){
			$email = $_SESSION['email'];
			//if($validate->check_password($password, $error_passwd)){
			$UM=new UserManager();
			$existuser=$UM->getUserByEmail($email);
			if(isset($existuser)){
				$hash = password_hash($password, PASSWORD_BCRYPT);
				//update database with new password
				$UM->updatePassword($email,$hash);
				echo '<meta http-equiv="Refresh" content="1; url=home.php">';
				//header("Location:home.php");
			}else{
				$formerror="Invalid User";
			}
		}else{
			$formerror="Please login first.";
		}
	}else{
		$formerror="Password and Confirm Password is not same.";
	}
}
?>


<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">

<h1>First Time Login: Reset Password</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>New Password</td>
    <td><input type="password" name="password"  pattern=".{1,}"   required title="Cannot be empty field" size="30"></td>
	<td><?php echo $error_name?>
  </tr>
  <tr>    
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword"  size="30"></td>
	<td><?php echo $error_passwd?>
  </tr> 
  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    </td>
    </td>
  </tr>
  <tr><?php echo $formerror; ?></tr> 
</table>
</form>
<?php
include 'includes/footer.php';
?>