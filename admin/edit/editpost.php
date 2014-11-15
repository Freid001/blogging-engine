<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../functions/getaccount.php");
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
<?php 
   //Check isset
   if(isset($_GET['id'])){
      $get_post = check($_GET['id']);
	  $query = $db->prepare("SELECT * FROM posts WHERE id='$get_post';"); 
	  $query->execute(); 
	  while ($row = $query->fetch()) { 
	     $title = $row["title"]; 
		 $image = $row["image"];
		 $post_text = $row["post"];
        }
		
    //Replace IMG with html post_image tags
	$post_text = str_replace("<img src='", "[img]", "$post_text");
	$post_text = str_replace("'>", "]", "$post_text");
	
	//Replace LINK with html a href tags
	$post_text = str_replace("<a href='", "[link]", "$post_text");
	$post_text = str_replace("]LINK", "", "$post_text");
	$post_text = str_replace("</a>", "[/link]", "$post_text");
	$post_text = str_replace("'target=_blank", "", "$post_text");
	
	//Replace TEXT COLOR space with html color tags
	$post_text = str_replace("<span style='color:", "[color:", "$post_text");
	$post_text = str_replace("'>", "]", "$post_text");
	$post_text = str_replace("</span>", "[/color]", "$post_text");
	
	//Replace TEXT SIZE space with html tag <b>
	$post_text = str_replace("<font size='", "[size=", "$post_text");
	$post_text = str_replace("'>", "]", "$post_text");
	$post_text = str_replace("</font>", "[/size]", "$post_text");
	
	//Replace BOLD space with html tag <b>
	$post_text = str_replace("<b>", "[b]", "$post_text");
	$post_text = str_replace("</b>", "[/b]", "$post_text");
	
	//Replace WHITE SPACE space with html tag <br />
	$post_text = str_replace("<br />", "", "$post_text");
	}
?>
<table width="85%" border="0">
  <tr>
    <td width="23%" rowspan="2" valign="top"><?php include("../adminmenu.php"); ?></td>
    <td width="77%" valign="top"><table width="95%" border="0" align="center" class="admintable">
      <tr>
        <th colspan="2">Select A Post</th>
      </tr>
      <tr>
        <td width="30%" height="34" class="twelvetext">List:</td>
        <td width="70%"><form action="editpost.php" method="get" name="form2">
          <select name="id">
            <?php
			//Get query after account access level check
			if (getaccount($db, $user, "level")>0){ 
				   $query = $db->prepare("SELECT * FROM posts"); 
				   } else {
				   $query = $db->prepare("SELECT * FROM posts WHERE Author='$user';"); 
				   }
            $query->execute(); 
            while ($row = $query->fetch()) { 
            $loop_id = $row["id"]; 
            $loop_title = $row["title"];
			$loop_author = $row["author"];
			echo "<option value='$loop_id'>$loop_title, $loop_author</option>"; 
            }
			?>
          </select>
          <input name="Submit" type="submit" id="Submit" value="Edit" />
        </form></td>
      </tr>
    </table></td>
  </tr>
  <form action="postedit.php" method="post" name="form1">
    <tr>
      <td width="82%" valign="top"><br />
          <?php if(isset($_GET['id'])){ ?>
          <table width="95%" border="0" align="center" class="admintable">
            <tr>
              <th colspan="2">Edit Post </th>
            </tr>
            <tr>
              <td height="34" class="twelvetext">id: </td>
              <td class="twelvetext"><?php echo "$get_post"; ?>
                  <input type="hidden" name="id" value="<?php echo "$get_post"; ?>" /></td>
            </tr>
            <tr>
              <td width="30%" height="34" class="twelvetext"> Title: </td>
              <td width="70%"><input name="title" type="text" id="title" value='<?php echo "$title"; ?>' size="70" />
              </td>
            </tr>
            <tr>
              <td height="36" class="twelvetext">Image URL: <span class="tentext">(Leave blank for defualt image)</span> </td>
              <td><input name="image" type="text" id="image" value='<?php echo "$image"; ?>' size="70" />
              </td>
            </tr>
            <tr>
              <td height="219" valign="top" class="twelvetext">Post: </td>
              <td><textarea name="textarea" cols="70" rows="10"><?php echo "$post_text"; ?></textarea>
                  <br />
                  <br />
                  <span class="twelvetext"><b>Tags:</b> images:<a href="javascript:addtext('img')">[img] ]</a> link:<a href="javascript:addtext('link')">[link][/link]</a> font color: <a href="javascript:addtext('color')">[color:#000000][/color]</a> size: <a href="javascript:addtext('size')">[size=12][/size]</a> bold: <a href="javascript:addtext('b')">[b][/b]<br />
                </a></span></td>
            </tr>
            <tr>
              <td> </td>
              <td><input name="Submit" type="submit" id="Submit" value="Submit" /></td>
            </tr>
          </table>
        <?php } ?>
      </td>
    </tr>
  </form>
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
