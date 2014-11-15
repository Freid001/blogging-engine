<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../pagetop.php");
?>
<script language="javascript" type="text/javascript">
function addtext(new_text) {
//Javascript to insert tags in to textbox.
	if(new_text=="img"){
	new_text = "[img] ]";
	}else if(new_text=="link"){
	new_text = "[link][/link]";
	}else if(new_text=="color"){
	new_text = "[color:#000000][/color] ";
	}else if(new_text=="size"){
	new_text = "[size=12][/size]";
	}else if(new_text=="b"){
	new_text = "[b][/b]";
	}
	var start_text = document.form1.textarea.value;
	var text = start_text + new_text;
	document.form1.textarea.value = text;
}
</script>
  
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
<form name="form1" method="post" action="postcreate.php">
  <table width="85%" border="0">
    <tr>
      <td width="23%" valign="top"><?php include("../adminmenu.php"); //Admin menu?></td>
      <td width="77%" valign="top"><table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">Create Post </th>
        </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext">Title: </td>
          <td width="70%"><label>
            <input name="title" type="text" id="title2" size="70">
            </label>
          </td>
        </tr>
        <tr>
          <td height="36" class="twelvetext">Image URL: <span class="tentext">(Leave blank for defualt image)</span> </td>
          <td><input name="image" type="text" id="image2" size="70">
          </td>
        </tr>
        <tr>
          <td height="219" valign="top" class="twelvetext">Post: </td>
          <td><textarea name="textarea" cols="70" rows="10"></textarea>
              <br>
              <br>
              <span class="twelvetext"><b>Tags:</b> images:<a href="javascript:addtext('img')">[img] ]</a> link:<a href="javascript:addtext('link')">[link][/link]</a> font color: <a href="javascript:addtext('color')">[color:#000000][/color]</a> size: <a href="javascript:addtext('size')">[size=12][/size]</a> bold: <a href="javascript:addtext('b')">[b][/b]<br>
              </a></span></td>
        </tr>
        <tr>
          <td> </td>
          <td><input name="Submit" type="submit" id="Submit" value="Submit"></td>
        </tr>
      </table></td>
      </tr>
  </table>
  <br>
  <br>
</form>
</div>
</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
