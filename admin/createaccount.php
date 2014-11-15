<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../pagetop.php");
?> 
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2><br />
<div align="center">
  <?php
  //Check isset
  if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['permissions'])&&$_POST['username']!=""&&$_POST['password']!=""){
      $post_username = check(strtolower ($_POST['username']));
      $post_password = check(strtolower ($_POST['password']));
      $post_permissions = check($_POST['permissions']); 
	  
	  //Add Salt
	  $post_password = md5("Adding salt".$post_password);
	  
	  //Check Username
	  $check_username = ""; 
	  $query = $db->prepare("SELECT * FROM admin WHERE username='$post_username'");
	  $query->execute();
	  while ($row = $query->fetch()) { 
	  $check_username = $row['username'];
	  }
	  
	  if($post_username!=$check_username){
	  //Add data to database
	  $query = "INSERT INTO admin(`username`,`password`,`level`) VALUES(:username, :password, :level)";
	  $statement = $db->prepare($query);
	  $statement->execute(array(':username' => $post_username, ':password' => $post_password, ':level' => $post_permissions));
	  echo "<br />You have successfully added the user: $post_username!<br /><a href='main.php'>Continue</a><br /><br />";
	  }else {
	  echo "<br /><div class='redtext'>ERROR: That username already exists!</div><br /><a href='newaccount.php'>Go Back</a><br /><br />";
	  }
	}else {
	  echo "<br /><div class='redtext'>ERROR: Please enter a username and password!</div><br /><a href='newaccount.php'>Go Back</a><br /><br />";
	}
?>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
