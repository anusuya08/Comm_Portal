<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;
use classes\util\Config;
require_once 'includes/password.php'; 
require_once 'includes/autoload.php';

$uid  = $_GET['uid'];
$validate=new Validation();

if(isset($uid )){
	$UM=new UserManager();
	$existuser=$UM->getUserById($uid);
	if(isset($existuser)){
		//update database with subscribe set to 0
		$UM->unsubscribe($uid);
		echo 'You have been unsubscribed';
		exit;
		echo '<meta http-equiv="Refresh" content="1; url=home.php">';
		//header("Location:home.php");
	}else{
		$formerror="Invalid User";
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