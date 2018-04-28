<?php
namespace classes\data;
use classes\entity\User;
use classes\util\DBUtil;
class UserManagerDB
{
    public static function fillUser($row){
        $user=new User();
        $user->id=$row["id"];
        $user->firstName=$row["firstname"];
        $user->lastName=$row["lastname"];
        $user->email=$row["email"];
		$user->role=$row["role"];
		$user->subscribe=$row["subscribe"];
        $user->password=$row["password"];
		$user->account_creation_time = $row["account_creation_time"];
        return $user;
    }
    public static function getUserByEmailPassword($email,$password){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
        //$sql="select * from tb_user where email='$email' and password='$password'";
		$sql="select * from tb_user where email='$email' ";
		
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
				$hash = $row['password'];
				if(password_verify($password, $hash)){
					$user=self::fillUser($row);
				}
            }
        }
        $conn->close();
        return $user;
    }
    public static function getUserByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }else{
			return false;
		}
        $conn->close();
        return $user;
    }
	public static function searchUser($search_user){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $search_user=mysqli_real_escape_string($conn,$search_user);
        $sql="select * from tb_user where email like '%".$search_user."%' or firstname like '%".$search_user."%' or lastname like '%".$search_user."%' ";
        $stmt = $conn->prepare($sql);
		$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
			 
			return $users;
        }else{
			echo "No user found";
		}
       $conn->close();
    }
	
	public static function getUserById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select * from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    public static function saveUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="call procSaveUser(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssi", $user->id,$user->firstName, $user->lastName, $user->email,$user->password, $user->account_creation_time, $user->role,$user->subscribe); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
    public static function updatePassword($email,$password){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET password='$password' WHERE email='$email';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			return true;
			//echo "Record updated successfully";
		} else {
			return false;
			//echo "Error updating record: " . $conn->error;
		}
		$conn->close();
    }
	public static function unsubscribe($uid){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET subscribe=0 WHERE id=$uid;";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			return true;
			//echo "Record updated successfully";
		} else {
			return false;
			//echo "Error updating record: " . $conn->error;
		}
		$conn->close();
    }	
	public static function updateUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="call procSaveUser(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssi", $user->id,$user->firstName, $user->lastName, $user->email,$user->password, $user->account_creation_time, $user->role); 
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();

    }	
    public static function deleteAccount($id){
        $conn=DBUtil::getConnection();
        $sql="DELETE from tb_user WHERE id='$id';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }		
    public static function getAllUsers(){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select * from tb_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	public static function SearchUsers($id){
        $users[]=array();
        $conn=DBUtil::getConnection();
        $sql="select from tb_user WHERE id='$id';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
        }
        $conn->close();
        return $users;
    }
	
}

?>