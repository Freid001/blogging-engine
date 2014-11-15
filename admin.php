<?php
//Get functions
include("connection.php");
include("pagetop.php");

//If already logged in
if(isset($user)&&$user!=""){
echo "<meta http-equiv='REFRESH' content='0;url=/admin/main.php'></HEAD>";
}
?>
  
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"> Admin Panel </h2>
<div align="center">
<form name="form1" method="post" action="admin/login.php">
<table width="17%" border="0" align="center">
  <tr>
    <td colspan="2">
	  <div align="center" class="redtext"><?php 
	  //Check for error and return error message
	  if(isset($_GET['error'])){ echo $_GET['error']; } 
	  ?></div></td>
    </tr>
  <tr>
    <td width="6%"><p class="twelvetext">Username: </p></td>
    <td width="94%"><input type="text" name="post_username"></td>
    </tr>
  <tr>
    <td><p class="twelvetext">Password: </p></td>
    <td><input type="password" name="post_password"></td>
  </tr>
  <tr>
    <td></td>
    <td><input name="submit" type="submit" value="Submit"></td>
    </tr>
</table>
</form>
</div>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
