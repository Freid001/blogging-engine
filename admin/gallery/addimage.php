<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../pagetop.php");
?> 
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
  <table width="85%" border="0">
    <tr>
      <td width="23%" valign="top"><?php include("../adminmenu.php"); //Admin menu?></td>
      <td width="77%" valign="top">
	  <form name="form1" method="post" action="insertimage.php">
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">Add New Image To Gallery</th>
        </tr>
        <tr>
          <td height="34" colspan="2" class="twelvetext">* To upload an image please us a image host and then submit the image url below: [<a href="http://imageshack.us/" target="_blank">Go To: Image Host</a>]</td>
          </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext">URL:</td>
          <td width="70%"><input name="url" type="text" id="url" size="70"></td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">Image Tag:</td>
          <td><textarea name="tag" cols="70" rows="3"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><input name="Submit" type="submit" id="Submit" value="Add New Image"></td>
        </tr>
      </table>
	  </form></td>
      </tr>
  </table>

</div>
</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
