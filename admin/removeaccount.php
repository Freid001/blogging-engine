<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/getaccount.php");
include("../pagetop.php");

//Check issset
if(isset($_POST['id'])){
$get_account = check($_POST['id']);
}else {
$get_account = "NULL"; 
}
?>
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
  <table width="85%" border="0" align="center">
    <tr>
      <td width="23%" rowspan="2" valign="top"><?php include("adminmenu.php"); //Admin menu ?></td>
      <td width="77%" valign="top"><table width="95%" border="0" align="center" class="admintable">
          <tr>
            <th colspan="2">Select An Account To Remove</th>
          </tr><?php if (getaccount($db, $user, "level")>1){ //Check account access level?>
          <tr>
            <td width="30%" height="34" class="twelvetext">List:</td>
            <td width="70%">
		    <form action="removeaccount.php" method="post" name="form2">
                <select name="id"><?php
				   //Select all accounts
				   $query = $db->prepare("SELECT * FROM admin;"); 
				   $query->execute(); 
				      while ($row = $query->fetch()) { 
					  $loop_id = $row["id"]; $loop_account = $row["username"]; 
					  echo "<option value='$loop_id'>$loop_account</option>"; 
				      }?></select>
                <input name="Submit" type="submit" value="Remove Account">
            </form>
		   </td>
          </tr>
		   <tr>
             <td></td>
			 <td class="twelvetext">
			 <?php
			 //Delete selected account
			 if($get_account!=""&&$get_account!="NULL"){ //Check that account is not admin account
			   if($get_account!=1){
                  $query = $db->prepare("DELETE FROM admin WHERE id=:id LIMIT 1;");
                  $query->execute(array(':id'=>$get_account));
				  echo "<br />Account Removed!<meta http-equiv='REFRESH' content='1;url=removeaccount.php'></HEAD><br /><br />";
		        }else {
			     echo "<br />You can not remove the admin account!<br /><br />";
				} 
			 }else {
			  echo "<br />Please select an account to remove!<br /><br />";
		     }				
		     ?>
			</td>
          </tr>
		  <?php } else { echo "<tr><td colspan='2'><div align='center' class='redtext'>You need level 2 permissions to uses this page!</div></td></tr>"; } ?>
      </table></td>
    </tr>
  </table>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
