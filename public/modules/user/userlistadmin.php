<?php
session_start();
require '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
require_once "PHPMailer/PHPMailerAutoload.php";

$UM=new UserManager();
$users=$UM->getAllUsers();


if(isset($_REQUEST["submitted"])){
    $search_user=$_REQUEST["search_user"];
  
    if($search_user!=''){
        $UM=new UserManager();
        //$existuser=$UM->getUserByEmail($email);
		$existuser=$UM->searchUser($search_user);
        if(isset($existuser)){
			// $id=$existuser->id;
			// $firstName=$existuser->firstName;
			// $lastName=$existuser->lastName;
			// $email=$existuser->email;
			// $role=$existuser->role;
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

if(isset($_POST["sendBulkmail"])){
    $mailList=$_POST["mailList"];
	$userIdList=$_POST["userIdList"];
	$mailContent = $_POST["mailContent"];
	$subject = $_POST["subject"];
	//print_r($mailList); exit;
	
    if(!empty($mailList) &&  trim($mailContent) != ""   &&  trim($subject) !=""){
		
			
		foreach ($mailList as $key => $to) {
			$mail = new PHPMailer;
			$mail->addAddress($to, "Admin");
			
			//Enable SMTP debugging.
			//$mail->SMTPDebug = 3;
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();
			//Set SMTP host name
			$mail->Host = "in-v3.mailjet.com";
			//Set this to true if SMTP host requires authentication
			$mail->SMTPAuth = true;
			//Provide username and password
			$mail->Username = "c8ba7dda35c18fdc86952068fe4bb36e";
			$mail->Password = "66f2bc986d242fc3245e6a8f02ea9a4f";
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";
			//Set TCP port to connect to
			//$mail->Port = 587;
			$mail->Port = 25;
			$mail->From = "kkanchi@gmail.com";
			$mail->FromName = "Admin";
			//$mail->addAddress("anusuyakathirvelu08@gmail.com", "Admin");
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mailContent_unsub ='<p> Click <a href="http://localhost/www/public/unsubscribe.php?uid='.$userIdList[$key].'" >here</a> to unsubscribe.</p>';
			$mail->Body = $mailContent.'<p>'.$mailContent_unsub.'</p>';
			if($mail->send()){
				//echo 'Sent ';
			}else{
				echo "<br>Error in sending mail: ".$mail->ErrorInfo;
			}
		}
	}
}

if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
	
 	
	<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="60%">
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
<br/><br/>Below is the list of Developers registered in community portal <br/><br/>
</form>
<form name="bulkmail" method="post" class="pure-form pure-form-stacked">
    <table class="pure-table pure-table-bordered" width="800">
            <tr>
			<thead>
               <th><input type="checkbox" onclick="toggle(this);" /></th>
               <th><b>First Name</b></th>
               <th><b>Last Name</b></th>
               <th><b>Email</b></th>
			   <th><b>Operation</b></th>
			   </thead>
            </tr>    
    <?php 
	
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
			
               <td>
			    <?php if($user->subscribe ==1): ?>
				<input type="checkbox" name="mailList[]" value="<?=$user->email?>"/>
				<input type="hidden" name="userIdList[]" value="<?=$user->id?>"/>
				 <?php endif; ?>
			   </td>
			   
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
			   <td>
					<a href='edituser.php?id=<?php echo $user->id ?>'>Edit</a>
					<?php if($_SESSION['role'] == 'superadmin'): ?>
						<?php if($user->role  == 'user'): ?>
							<a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete </a>
						<?php endif; ?>
					<?php endif; ?>
													
			   </td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
	<p style="padding-left:50px;">Subject: <input type="text" name="subject" size="80" /></p>
	<p style="padding-left:50px;">Mail Content: <br><textarea rows="5" cols="100" name="mailContent" ></textarea></p>
	<p style="padding-left:50px;"><input type="submit" name="sendBulkmail" value="Send Bulk Mail" class="pure-button pure-button-primary"></p>
	</form>
	<script type="text/javascript">

    function toggle(source) {
		var checkboxes = document.querySelectorAll('input[type="checkbox"]');
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i] != source)
				checkboxes[i].checked = source.checked;
		}
	}
	</script>
    <?php 
}
?>



<?php
include '../../includes/footer.php';
?>