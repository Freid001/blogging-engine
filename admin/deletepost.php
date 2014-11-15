<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/getpost.php");
include("../functions/getaccount.php");
include("../pagetop.php");

//Check issset
if(isset($_GET['id'])){
$get_post = check($_GET['id']);
}else {
$get_post = 0; 
}
$post_id = getpost($db, $get_post, "id"); 
?>
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
  <table width="85%" border="0" align="center">
    <tr>
      <td width="23%" valign="top"><?php include("adminmenu.php"); //Admin menu?></td>
            <td width="77%" valign="top">
			<table width="95%" border="0" align="center" class="admintable">
          <tr>
            <th colspan="2">Select A Post To Delete</th>
          </tr>
          <tr>
            <td width="30%" height="34" class="twelvetext">List:</td>
            <td width="70%"><form action="deletepost.php" method="get" name="form2">
                <select name="id"><?php
				   //Select all posts
				   if (getaccount($db, $user, "level")>0){ //Check user access
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
				    }?>
				</select>
                <input name="Submit" type="submit" value="Delete Post">
            </form>
		   </td>
          </tr>
		   <tr>
             <td></td>
			 <td class="twelvetext"><?php
			//Delete selected post
			if($post_id!=0){
			   if (getaccount($db, $user, "level")>0){  ///Check access level
				   $query = $db->prepare("DELETE FROM posts WHERE id=:id LIMIT 1;");
                   $query->execute(array(':id'=>$post_id));
				   echo "<br />Post deleted! (id: $post_id) <meta http-equiv='REFRESH' content='1;url=deletepost.php'></HEAD><br /><br />";
			   }else {
				   if(getpost($db, $get_post, "author")==$user){ //check that author = user
				      $query = $db->prepare("DELETE FROM posts WHERE id=:id LIMIT 1;");
                      $query->execute(array(':id'=>$post_id));
				      echo "<br />Post deleted! (id: $post_id) <meta http-equiv='REFRESH' content='1;url=deletepost.php'></HEAD><br /><br />";
				   }else {
				   echo "You can not delete another accounts posts!";
				   }
			   }
			}else {
			 echo "<br />Please select a post to delete!<br /><br />";
		    }				
		    ?></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
