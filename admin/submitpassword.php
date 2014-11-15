<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../pagetop.php");
?> 
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
   <?php
   $post_old_password = check(strtolower ($_POST['old']));
   $post_new_password = check(strtolower ($_POST['new']));
   
   //Check isset
   if(isset($post_old_password)&&isset($post_new_password)&&$post_old_password!=""&&$post_new_password!=""){
       
	   //Add Salt
	   $check_old_password_1 = md5("Adding salt".$post_old_password);
	   $post_new_password = md5("Adding salt".$post_new_password);
	   
	   //Check Password
	   $query = $db->prepare("SELECT * FROM admin WHERE username='$user'");
	   $query->execute();
	   while ($row = $query->fetch()) { 
	   $check_old_password_2 = $row['password'];
	   }
	   if($check_old_password_1==$check_old_password_2){
	   
	   //Change Password
	   $query = $db->prepare("UPDATE admin SET password=:password WHERE username=:user");
	   $query->execute(array(':password'=>$post_new_password, ':user'=>$user));
	   echo "<br />You have successfully changed your accounts password!<br /><a href='main.php'>Continue</a><br /><br />";
	   }else {
	   echo "<br /><div class='redtext'>ERROR: Your old password does not match!</div><br /><a href='changepassword.php'>Go Back</a><br /><br />";
	   }
	}else {
	   echo "<br /><div class='redtext'>ERROR: Please enter a old and new password!</div><br /><a href='changepassword.php'>Go Back</a><br /><br />";
	}
	?>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
