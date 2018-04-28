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

if(isset($_GET["id"])){
	  $UM=new UserManager();
	  $existuser=$UM->getUserById($_GET["id"]);
	  $id=$existuser->id;
	  $firstName=$existuser->firstName;
	  $lastName=$existuser->lastName;
	  $email=$existuser->email;
	  $password=$existuser->password;
	  $role=$existuser->role;
	}

if(isset($_REQUEST["submitted"])){
	$id=$_REQUEST["id"];
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
	$password=$_REQUEST["password"];
    $role=$_REQUEST["role"];
    
    if($id != '' && $firstName!='' && $lastName!='' && $email!=''){
        $UM=new UserManager();
        $user=new User();
		$user->id=$id;
        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
		$user->password=password_hash($password, PASSWORD_BCRYPT);
		$user->role=$role;
		$UM->updateUser($user);
		echo '<meta http-equiv="Refresh" content="1; url=./updatethankyou.php">';
        
    }else{
        $formerror="Please fill in the fields";
    }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Edit User Profile</h1>
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
  <!--
<tr>    
    <td>Password</td>
    <td><input type="text" name="password" value="<?=$password?>" size="50"></td>
  </tr>  
 
  <tr>    
    <td>Role</td>
    <td><input type="text" name="role" value="<?=$role?>" size="50"></td>
  </tr>  
  --> 
  <tr>
   <br> <td>
		<input type="hidden" name="id" value="<?=$id?>">
       <input type="submit" name="submitted" value="Submit">
       <input type="reset" name="reset" value="Reset">
    </td>
  </tr>
</table>
</form>

<?php
include '../../includes/footer.php';
?>