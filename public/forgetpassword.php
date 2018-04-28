<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
require_once 'includes/password.php';
include 'includes/header.php';
require_once "PHPMailer/PHPMailerAutoload.php";
$formerror="";

$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();
$headers ="ghj";

if(isset($_POST["submitted"])){
    $email=$_POST["email"];
	$UM=new UserManager();
	$existuser=$UM->getUserByEmail($email);
	if(!$existuser){
		echo 'No user found';
	}else if(isset($existuser)){
			//generate new password
			$newpassword=$UM->randomPassword(6,1,"lower_case,upper_case,numbers");
			//mail($email,"password",$newpassword);
			$hash = password_hash($newpassword[0], PASSWORD_BCRYPT);
			//update database with new password
			$UM->updatePassword($email,$hash);
			$mail = new PHPMailer;
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
			$mail->FromName = "Anusuya";
			$mail->addAddress(trim($existuser->email), "Admin");
			$mail->isHTML(true);
			$mail->Subject = "Forgot Password";
			$mail->Body = '<p>Dear '.ucwords($existuser->firstName.' '.$existuser->lastName).',<br><p>Your new password is '.$newpassword[0]. '</p><p> Please click <a href="http://localhost/www/public/login.php?pwd='.$newpassword[0].'&email='.trim($existuser->email).'" >here</a> to login with above password.</p>';
			$mail->AltBody = '<p>Your new password is '.$newpassword[0]. '</p><p> Please click <a href="'.$_SERVER['SERVER_NAME'].'/www/public/login.php?pwd='.$newpassword[0].'&email='.trim($existuser->email).'" >here</a> to login with above password.</p>';
			if($mail->send()){
				echo '<br><h4><p>Hi '.ucwords($existuser->firstName.' '.$existuser->lastName).',</p></p>Thank You <br> Your password has been sent to '.$email.'. Please check your mail.</h4></p>';
			}else{
				echo "<br>Error in sending mail: ".$mail->ErrorInfo;
			}
		
			//mail($email,"password","ksgh",$headers);			
			//$formerror="Valid email user. password: ".$newpassword[0];
			//coding for sending email
			// do work here
			//$formerror='<p>Your new password is '.$newpassword[0]. '</p><p> Please click <a href="http://localhost/www/public/login.php" >here</a> to login with above password.</p>';
			
			//$formerror="New password have been sent to ".$email;
			//$formerror="New password have been sent to ".$email;
			//header("Location:home.php");
	}else{
			$formerror="Invalid email user";
	}
}
function generateStrongPassword($length = 6, $add_dashes = false, $available_sets = 'lud')
{
    $sets = array();
    if(strpos($available_sets, 'l') !== false)
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    if(strpos($available_sets, 'u') !== false)
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if(strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    if(strpos($available_sets, 's') !== false)
        $sets[] = '!@#$%&amp;*?';
 
    $all = '';
    $password = '';
    foreach($sets as $set)
    {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }
 
    $all = str_split($all);
    for($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];
 
    $password = str_shuffle($password);
 
    if(!$add_dashes)
        return $password;
 
    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while(strlen($password) > $dash_len)
    {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}

?>
<?php if(! isset($_POST["submitted"])):?>
<html>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<body>

<h1>Forget Password</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30"></td>
	<td><?php echo $error_name?>
  </tr> 
  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    </td>
  </tr>
  <tr><?php echo $formerror?></tr>
</table>
</form>
<?php
include 'includes/footer.php';
?>
<?php endif; ?>