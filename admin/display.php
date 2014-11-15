<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/listflagged.php");
include("../functions/getaccount.php");
include("../pagetop.php");
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
	var start_text = document.form6.textarea.value;
	var text = start_text + new_text;
	document.form6.textarea.value = text;
}
</script>
<div id="main">
  <div id="full">
    <h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
    <div align="center">
      <?php
	  //Get id
	  $id = check($_GET['id']);
	  
	  //Title
	  if($id==1){
           $title = check($_POST['title']);
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$title,':id'=>1));
	       echo "Title Updated!";
	  }
	  
	  //Header
	  if($id==2){
           $header = check($_POST['header']);
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$header,':id'=>2));
	       echo "Header Updated!";
	  }
	  
	  //Icon
	  if($id==3){
           $icon = check($_POST['icon']);
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$icon,':id'=>3));
	       echo "Icon Updated!";
	  }
	  
	  //Style
	  if($id==4){
           $post_style = check($_POST['style']);
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$post_style,':id'=>4));
		   echo "<meta http-equiv='refresh' content='0; url=/admin/display.php?id=6'> ";
	       echo "Style/Theme Updated!";   
	  }
	  
	  //Custom Style
	  if($id==5){
           $post_style = check($_POST['custom']);
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$post_style,':id'=>4));
		   echo "<meta http-equiv='refresh' content='0; url=/admin/display.php?id=6'> ";
	       echo "Style/Theme Updated!";
	  }
	  
	  //Refresh
	  if($id==6){
		   echo "<meta http-equiv'refresh' content='0'>";
	  }
	  
	  //Welcome Text
	  if($id==7){
		   $welcomeText = strip_tags($_POST['textarea']);
		   
		    //Replace IMG with html post_image tags
	       $welcomeText = str_replace("[img]", "<img src='", "$welcomeText");
	       $welcomeText = str_replace("]", "'>", "$welcomeText");
	    
	       //Replace LINK with html a href tags
	       $welcomeText = str_replace("[link'>", "<a href='", "$welcomeText");
	       $welcomeText = str_replace("[/link'>", " 'target=_blank'>LINK</a>", "$welcomeText");
	  
	       //Replace TEXT COLOR space with html color tags
	       $welcomeText = str_replace("[color:", "<span style='color:", "$welcomeText");
	       $welcomeText = str_replace("]", "'>", "$welcomeText");
	       $welcomeText = str_replace("[/color'>", "</span>", "$welcomeText");
	  
	       //Replace TEXT SIZE space with html tag <b>
	       $welcomeText = str_replace("[size=", "<font size='", "$welcomeText");
	       $welcomeText = str_replace("]", "'>", "$welcomeText");
	       $welcomeText = str_replace("[/size'>", "</font>", "$welcomeText");
	  
	       //Replace BOLD space with html tag <b>
	       $welcomeText = str_replace("[b'>", "<b>", "$welcomeText");
	       $welcomeText = str_replace("[/b'>", "</b>", "$welcomeText");
	     
	       //Replace WHITE SPACE space with html tag <br />
	       $welcomeText = str_replace("\n", "<br />", "$welcomeText");
		   
	       $query = $db->prepare("UPDATE style SET style=:style WHERE id=:id");
	       $query->execute(array(':style'=>$welcomeText,':id'=>5));
	       echo "Welcome Text Updated!";
	  }

	  //Get style
	  $query = $db->prepare("SELECT * FROM style"); 
	  $result = $query->fetchAll( PDO::FETCH_ASSOC );
		foreach( $result as $row ){
				
				//Title
				if($row["name"] == 'title' ){
					$title = $row["style"]; 
				}	

				//Icon
				if($row["name"] == 'icon' ){
					$icon = $row["style"]; 
				}	

				//Header
				if($row["name"] == 'header' ){
					$header = strtoupper( $row["style"] ); 
				}	

				//CSS
				if($row["name"] == 'css' ){
					$style = $row["style"]; 
				}	

				//Welcome Text
				if($row["name"] == 'welcomeText' ){
					$welcomeText = $row["style"]; 
				}				
		}
	  
	  //Replace Characters
      //Replace IMG with html post_image tags
      $welcomeText = str_replace("<img src='", "[img]", "$welcomeText");
	  $welcomeText = str_replace("'>", "]", "$welcomeText");
	
	  //Replace LINK with html a href tags
	  $welcomeText = str_replace("<a href='", "[link]", "$welcomeText");
	  $welcomeText = str_replace("]LINK", "", "$welcomeText");
	  $welcomeText = str_replace("</a>", "[/link]", "$welcomeText");
	  $welcomeText = str_replace("'target=_blank", "", "$welcomeText");
	
	  //Replace TEXT COLOR space with html color tags
	  $welcomeText = str_replace("<span style='color:", "[color:", "$welcomeText");
	  $welcomeText = str_replace("'>", "]", "$welcomeText");
	  $welcomeText = str_replace("</span>", "[/color]", "$welcomeText");
	
	  //Replace TEXT SIZE space with html tag <b>
	  $welcomeText = str_replace("<font size='", "[size=", "$welcomeText");
	  $welcomeText = str_replace("'>", "]", "$welcomeText");
	  $welcomeText = str_replace("</font>", "[/size]", "$welcomeText");
	
	  //Replace BOLD space with html tag <b>
	  $welcomeText = str_replace("<b>", "[b]", "$welcomeText");
	  $welcomeText = str_replace("</b>", "[/b]", "$welcomeText");
	
	  //Replace WHITE SPACE space with html tag <br />
	  $welcomeText = str_replace("<br />", "", "$welcomeText");
	  ?>
      <table width="85%" border="0">
        <tr>
			<td width="23%" valign="top"><?php include("adminmenu.php"); //Admin menu ?></td>
			<td width="77%" valign="top">
			<table width="95%" border="0" align="center" class="admintable">
			  <tr>
				<th colspan="3">Display</th>
			  </tr>
			  <tr>
				<td width="30%" height="26"class="twelvetext">Site Title:</td>
				<td width="30%"class="twelvetext"><form id="form1" name="form1" method="post" action="/admin/display.php?id=1">
					<input name="title" type="text" value="<?php echo "$title"; ?>" />
					<input type="submit" name="Submit" value="Update" />
				</form></td>
			  </tr>
			  <tr>
				<td height="26" class="twelvetext">Header Image: </td>
				<td class="twelvetext"><form id="form2" name="form2" method="post" action="/admin/display.php?id=2">
				   <input name="header" type="text" value="<?php echo "$header"; ?>" />
				  <input type="submit" name="Submit" value="Update" />
				</form></td>
			  </tr>
			  <tr>
				<td height="26" class="twelvetext">Icon Image: </td>
				<td class="twelvetext"><form id="form3" name="form3" method="post" action="/admin/display.php?id=3">
					<input name="icon" type="text" value="<?php echo "$icon"; ?>" />
					<input type="submit" name="Submit" value="Update" />
				</form></td>
			  </tr>
			  <tr>
				<td height="26" class="twelvetext">Style Sheet (Theme) </td>
				<td class="twelvetext"><form id="form4" name="form4" method="post" action="/admin/display.php?id=4">
					<select name="style">
					  <option value="/styles/aero.css" <?php if($style=="/styles/aero.css") { echo "selected='selected'"; }; ?> >Aero</option>
					  <option value="/styles/basix.css" <?php if($style=="/styles/basix.css") { echo "selected='selected'"; }; ?>>Basix</option>
					  <option value="" <?php if($style!="/styles/basix.css" && $style!="/styles/aero.css") { echo "selected='selected'"; }; ?>>Custom</option>
					</select>
					<input type="submit" name="Submit" value="Update" />
				</form></td>
			  </tr>
			  <tr>
				<td height="26" class="twelvetext">Custom Style Sheet URL: </td>
				<td class="twelvetext"><form id="form5" name="form5" method="post" action="/admin/display.php?id=5">
					<input type="text" name="custom" />
					<input type="submit" name="Submit" value="Update" />
				</form></td>
			  </tr>
			</table>
			<br />
			<br />
			<table width="95%" border="0" align="center" class="admintable">
			  <tr>
				<th colspan="3">Welcome Text </th>
			  </tr>
			  <tr>
				<td width="30%"class="twelvetext"><form id="form6" name="form6" method="post" action="/admin/display.php?id=7">
					<div align="center">
					  <textarea name="textarea" cols="100" rows="4"><?php echo "$welcomeText"; ?></textarea>
					</div>
				  <div align="center"><b>Tags:</b> images:<a href="javascript:addtext('img')">[img] ]</a> link:<a href="javascript:addtext('link')">[link][/link]</a> font color: <a href="javascript:addtext('color')">[color:#000000][/color]</a> size: <a href="javascript:addtext('size')">[size=12][/size]</a> bold: <a href="javascript:addtext('b')">[b][/b]</a><br />
						<input name="Submit" type="submit" id="Submit" value="Update" />
					</div>
				</form></td>
			  </tr>
			</table>
			</tr>
        </table>
		</div>
	</div>
</div>
<?php include("../footer.php"); ?>
</body></html>