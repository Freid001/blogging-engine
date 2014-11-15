<?php
//Get connection
include("../connection.php");

//Get form data
$username = check($_POST['post_username']);
$password = check($_POST['post_password']);
$password = md5("Adding salt".$password);
$username_check = "";
$password_check = "";

 //Check issset
 if(isset($username)&&$username!=""&&isset($password)&&$password!=""){

      //Get check password
      $query = $db->prepare("SELECT * FROM admin WHERE username= :username"); 
      $query->execute(array(':username' => $username)); 
      while ($row = $query->fetch()) { 
      $username_check = $row["username"];  
      $password_check = $row["password"];  
      }
   
      //Check login details
      if($username==$username_check){
      if($password==$password_check){
      $_SESSION['username'] = $username; 
      echo "<meta http-equiv='REFRESH' content='0;url=main.php'>";
      }else {
      echo "<meta http-equiv='REFRESH' content='0;url=../admin.php?error=That password is incorrect!'>";
      }
      }else {
      echo "<meta http-equiv='REFRESH' content='0;url=../admin.php?error=That user does not exist!'>";
      }
    }else {
      echo "<meta http-equiv='REFRESH' content='0;url=../admin.php?error=Please enter a username & password!'>";
    }
?>