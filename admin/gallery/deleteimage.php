<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../functions/getimage.php");
include("../../functions/getaccount.php");
include("../../pagetop.php");

//Check issset
if(isset($_GET['id'])){
$get_image = check($_GET['id']);
}else {
$get_image = 0; 
}
$post_id = getimage($db, $get_image, "id"); 
?>

<script type="text/javascript">
//Function to get url of image and display on screen
function findimage(image)
{ 
var url=image.split("|");
image = url[1]; 
var showimage = "<img src='" + image + "' width='250' height='125' border='1'/>";
document.getElementById("showimage").innerHTML=showimage;
}
</script>

<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>

<div align="center">
  <table width="85%" border="0" align="center">
    <tr>
      <td width="23%" rowspan="2" valign="top"><?php include("../adminmenu.php"); //Admin menu ?></td>
      <td width="77%" valign="top"><table width="95%" border="0" align="center" class="admintable">
          <tr>
            <th colspan="2">Select A Image To Delete</th>
          </tr>
          <tr>
            <td width="30%" height="34" class="twelvetext">List:</td>
            <td width="70%"><form action="deleteimage.php" method="get" name="form2">
                <select name="id" onchange="findimage(this.value)"/><?php
				   //Get images
				   if (getaccount($db, $user, "level")>0){ //Check access level
				   $query = $db->prepare("SELECT * FROM gallery"); 
				   } else {
				   $query = $db->prepare("SELECT * FROM gallery WHERE Author='$user';"); 
				   }
				   $query->execute(); 
				   while ($row = $query->fetch()) { 
                          $loop_id = $row["id"]; 
                          $loop_tag = $row["tag"];
			              $loop_image = $row["image"];
						  $loop_author = $row["author"];
			              echo "<option value='$loop_id|$loop_image'>$loop_tag, $loop_author</option>"; 
		 		    }?></select>
                <input name="Submit" type="submit" value="Delete Image">
            </form>
		   </td>
          </tr>
		   <tr>
             <td></td>
			 <td class="twelvetext"><?php
			//Delete selected image
			if($post_id!=0){
			   if (getaccount($db, $user, "level")>0){ 
				   $query = $db->prepare("DELETE FROM gallery WHERE id=:id LIMIT 1;");
                   $query->execute(array(':id'=>$post_id));
				   echo "<br />Image post deleted! (id: $post_id) <meta http-equiv='REFRESH' content='1;url=deleteimage.php'></HEAD><br /><br />";
			   }else {
				   if(getimage($db, $get_image, "author")==$user){
				      $query = $db->prepare("DELETE FROM gallery WHERE id=:id LIMIT 1;");
                      $query->execute(array(':id'=>$post_id));
				      echo "<br />Image post deleted! (id: $post_id) <meta http-equiv='REFRESH' content='1;url=deleteimage.php'></HEAD><br /><br />";
				   }else {
				   echo "You can not delete another accounts image post!";
				   }
			   }
			}else {
			 echo "<br />Please select a image to delete!<br /><br />
			 <b>Selected Image:</b><br /><span id='showimage'</span>"; //Display JavaScript image here
		    }					
		    ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>

</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
