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
	  <form name="form1" method="post" action="createaccount.php">
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">A New Blog Poster</th>
        </tr><?php if (getaccount($db, $user, "level")>1){ //Check access level?>
        <tr>
          <td width="23%" height="36" class="twelvetext">Username:</td>
          <td width="77%"><input name="username" type="text" id="username" size="70"></td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">Password:</td>
          <td><input name="password" type="password" id="password" size="70"></td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">Permissions:</td>
          <td><select name="permissions">
              <option value="0" selected="selected">Poster</option>
              <option value="1">Moderator</option>
              <option value="2">Admin</option>
            </select></td>
        </tr>
        <tr>
          <td></td>
          <td class="twelvetext">
		    <span class="redtext">Admin</span> - Full access all permissions with additional ability to create and remove accounts. <br />
            <span class="bluetext">Moderator</span> - Can create, edit, delete own posts and can edit, delete any other accounts posts. Can add, delete own images and delete any accounts images. <br />
            <span class="yellowtext">Poster</span> - Limited access can create, edit, delete there own posts and add, delete own images. 
		  </td>
        </tr>
        <tr>
          <td></td>
          <td><input name="Submit" type="submit" id="Submit" value="Create New User"></td>
        </tr>
		<?php } else { echo "<tr><td colspan='2'><div align='center' class='redtext'>You need level 2 permissions to uses this page!</div></td></tr>"; } ?>
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
