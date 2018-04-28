<?php
namespace classes\business;
use classes\entity\User;
use classes\data\UserManagerDB;


class UserManager
{
    public static function getAllUsers(){
        return UserManagerDB::getAllUsers();
    }
    public function getUserByEmailPassword($email,$password){
        return UserManagerDB::getUserByEmailPassword($email,$password);
    }
    public function getUserByEmail($email){
        return UserManagerDB::getUserByEmail($email);
    }
	public function searchUser($search_user){
        return UserManagerDB::searchUser($search_user);
    }
    public function getUserById($id){
        return UserManagerDB::getUserById($id);
    }	
    public function saveUser(User $user){
        UserManagerDB::saveUser($user);
    }
	public function updateUser(User $user){
        UserManagerDB::updateUser($user);
    }
	public function updatePassword($email,$password){
        UserManagerDB::updatePassword($email,$password);
    }
	public function unsubscribe($uid){
        UserManagerDB::unsubscribe($uid);
    }
	public function deleteAccount($id){
        UserManagerDB::deleteAccount($id);
    }
	public function randomPassword($length,$count, $characters) 
	{
		// $length - the length of the generated password
		// $count - number of passwords to be generated
		// $characters - types of characters to be used in the password
		 
		// define variables used within the function    
		$symbols = array();
		$passwords = array();
		$used_symbols = '';
		$pass = '';
 
		// an array of different character types    
		$symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
		$symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$symbols["numbers"] = '1234567890';
		$symbols["special_symbols"] = '!?~@#-_+<>[]{}';
 
		$characters = explode(",",$characters); // get characters types to be used for the passsword
		foreach ($characters as $key=>$value) {
			$used_symbols .= $symbols[$value]; // build a string with all characters
		}
		$symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
		 
		for ($p = 0; $p < $count; $p++) {
			$pass = '';
			for ($i = 0; $i < $length; $i++) {
				$n = rand(0, $symbols_length); // get a random character from the string with all characters
				$pass .= $used_symbols[$n]; // add the character to the password string
			}
			$passwords[] = $pass;
		}
		return $passwords; // return the generated password
	} //end of generate random password function
}

?>