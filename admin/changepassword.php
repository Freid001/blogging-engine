<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/getaccount.php");
include("../pagetop.php");
?>
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>

<div align="center">
  <table width="85%" border="0">
    <tr>
      <td width="23%" valign="top"><?php include("adminmenu.php"); //Admin menu ?></td>
      <td width="77%" valign="top">
	  <form name="form1" method="post" action="submitpassword.php">
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">Change My Password</th>
        </tr>
        <tr>
          <td width="23%" height="36" class="twelvetext">Username:</td>
          <td width="77%" class="twelvetext"><?php echo "$user"; ?></td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">Old Password:</td>
          <td><input name="old" type="password" id="old" size="70"></td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">New Password:</td>
          <td><input name="new" type="password" id="new" size="70"></td>
        </tr>
        <tr>
          <td></td>
          <td><input name="Submit" type="submit" id="Submit" value="Change Password"></td>
        </tr>
      </table>
	  </form></td>
      </tr>
  </table>
</div>

</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
