<?php
namespace classes\business;

use classes\entity\User;
use classes\data\UserManagerDB;

class Validation
{
	public function check_name($input, &$error)
	{
		if (!preg_match("/^[a-zA-Z ]*$/",$input)) 
		{ 
			$error = "Only letters and white space allowed"; 
			return false;
		}
		return true;
	}
	
	public function check_password($input, &$error)
	{
		if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/",$input))
		{ 
			$error = "Password must consist of at least 6 characters with at least one uppercase letter, one lowercase letter and one digit."; 
			return false;
		}
		return true;
	}
}
?>