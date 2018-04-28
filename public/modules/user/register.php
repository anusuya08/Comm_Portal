<?php

require_once '../../includes/password.php';
include '../../includes/header.php';
use classes\util\Config;
require_once '../../includes/autoload.php';
use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";

$firstName="";
$lastName="";
$email="";
$password="";
date_default_timezone_set('Asia/Singapore');
if(isset($_REQUEST["submitted"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
    
    if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
        $UM=new UserManager();
        $user=new User();
        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
        $user->password=  password_hash($password, PASSWORD_BCRYPT);
		$user->account_creation_time=date('Y-m-d');
        $user->role="user";
		$user->subscribe=1;
        $existuser=$UM->getUserByEmail($email);
		//print_r($existuser);exit;
        if(!$existuser){
            // Save the Data to Database
            $UM->saveUser($user);
			//exit;
            #header("Location:registerthankyou.php");
			echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
        }
        else{
            $formerror="User Already Exist";
        }
    }else{
        $formerror="Please fill in the fields";
    }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Registration Form</h1>
<div><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" value="<?=$password?>" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="password" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.cpassword.pattern = RegExp.escape(this.value);
"></td>
  </tr>  
  <tr>    
    <td>Confirm Password</td>
    <td><input type="password" title="Please enter the same Password as above" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" value="<?=$password?>" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
"></td>
  </tr>  
  <tr>
   <br> <td>
       <input type="submit" name="submitted" value="Submit">
       <input type="reset" name="reset" value="Reset">
    </td>
  </tr>
</table>
</form>

<?php
include '../../includes/footer.php';
?>