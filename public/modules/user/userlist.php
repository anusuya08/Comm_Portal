<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new UserManager();
$users=$UM->getAllUsers();
if(isset($_REQUEST["submitted"])){
    $search_user=$_REQUEST["search_user"];
  
    if($search_user!=''){
        $UM=new UserManager();
        //$existuser=$UM->getUserByEmail($email);
		$existuser=$UM->searchUser($search_user);
		//print_r($existuser); exit;
        if(isset($existuser)){
			// $id=$existuser->id;
			$firstName=$existuser->firstName;
			$lastName=$existuser->lastName;
			$email=$existuser->email;
			$role=$existuser->role;
			$strenc = rawurlencode(json_encode($existuser));
			header("Location:http://localhost/www/public/search.php?results=".$strenc."");

        }
        else{
            $formerror="User Already Exist";
        }
    }else{
        $formerror="Please fill in the fields";
    }
}
if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
		<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>Search String</td>
    <td><input type="text" name="search_user"  required title="Cannot be empty field" size="30"></td>
  </tr>

  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Search" class="pure-button pure-button-primary">
    </td>
    </td>
  </tr>

   
</table>
</form>
    <br/><br/>Below is the list of Developers registered in community portal <br/><br/>
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><b>Id</b></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   </thead>
            </tr>    
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
    <?php 
}
?>



<?php
include '../../includes/footer.php';
?>