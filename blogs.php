<?php
//Get functions
include("connection.php");
include("functions/orderposts.php");
include("functions/getpost.php");
include("functions/getaccount.php");
include("pagetop.php");
?>
<div id="main">
<div id="full">
   <?php 
   //Check isset
   if(isset($_GET['id'])){
     $get_post = check($_GET['id']);

     //Set variables
     $title = getpost($db, $get_post, "title");
     $likes = getpost($db, $get_post, "likes");
     echo "<h2><b><img src='$icon' alt='icon'> <u>$title</u></b></h2>";
     echo "<div id='dash'></div>";
     ?>
	 
     <table width="100%"><tr><td>
     <div class="twelvetext" id="postimage">
     <img src="<?php echo getpost($db, $get_post, "image"); //Echo image url ?>" alt="icon" width="300" height="175">
   
     <?php
     //Echo post details
     echo "<br /><b>Author:</b> "; echo getpost($db, $get_post, "author");
     echo "<div id='dash'></div>";
     echo "<b>Date:</b> "; echo getpost($db, $get_post, "time");
     echo "<div id='dash'></div>";
     echo "<b>Likes:</b> ";
     if($likes>0){ echo "$likes "; } else { echo "0 "; }; 
       ?>
   
       <a href="blograte.php?<?php echo"id=$get_post&type=like"; //Echo like url ?>"><span class="greentext">[LIKE]</span></a> 
       <a href="blograte.php?<?php echo "id=$get_post&type=dislike" //Ech dislike url ?>"><span class="redtext">[DISLIKE]</span></a>
       <div id="dash"></div>
       <a href="flag.php?<?php echo "id=$get_post&&type=posts" //Echo flag url ?>">[Flag Post]</a>
	   <a href="<?php echo getpost($db, $get_post, "image"); ?> " target="_blank">[Image References]</a>
       <div id="dash"></div>
       </span></div>
       <div class="twelvetext" id="posttext"><?php
       echo getpost($db, $get_post, "post"); //Echo post
       echo "<div id='dash'></div>";
       echo "<br /><h2><strong><u>Comments</u></strong></h2>";
       ?>
   
   <form name="form1" method="post" action="postcomment.php?id=<?php echo "$get_post"; ?>">
     <table width="100%" border="0">
       <tr>
         <td width="10%"><div class="twelvetext">Name:</div></td>
         <td width="90%"><input name="name" type="text" id="name"></td>
       </tr>
	   <tr>
         <td width="10%"><div class="twelvetext">Email:</div></td>
         <td width="90%"><input name="email" type="text" id="name"> <div class='tentext'>(Leave blank to be anonymous!)</div></td>
       </tr>
       <tr>
         <td valign="top"><div class="twelvetext">Comment:</div></td>
         <td><textarea name="textarea" cols="30" rows="3"></textarea></td>
       </tr>
	     <td valign="top"></td>
         <td><input type="submit" name="Submit" value="Submit"></td>
       </tr>
     </table>
   </form>
   
   <?php
   //Echo post comments
   echo "<div id='dash'></div>"; 
   $query = $db->prepare("SELECT * FROM comments WHERE post='$get_post' ORDER BY id DESC;"); 
   $query->execute(); 
   while ($row = $query->fetch()) { 
      $comment_id = $row["id"]; 
      $name = $row["name"]; 
      $email = $row["email"];
      $comment = $row["comment"];
      $date = $row["date"];
   
      echo "<br /><b>$name:</b> $comment <a href='flag.php?id=$comment_id&&type=comments'>[FLAG]</a>"; 
      //Check access level and show delete icon if login and level >0 
      if (isset($user)&&getaccount($db, $user, "level")>0){ 
	  echo " <a href='deletecomment.php?id=$comment_id'>[X]</a>"; 
      }
      echo "<br /><i><div class='tentext'>Email: <a href='mailto:$email'>$email</a>, Comment posted on: $date</div></i><br />";
      echo "<div id='dash'></div>";
    }
   ?></div>
   </td></tr></table>
   
   <?php 
   }else {
   //Get page id and set post range
   echo "<h2><img src='$icon' alt='icon'><u>Recent Blog Posts</u><br /></h2><div id='dash'></div>";
   if(isset($_GET['pageid'])&&$_GET['pageid']>0){
      $i = check($_GET['pageid']);
      $link = check($_GET['pageid']);
      $i = 3 * $i; 
      $i = $i - 2; 
    }else {
      $i = 1; 
      $link = 1; 
    }
   ?>
   
   <table width="100%" border="0">
     <tr><td><?php orderposts($db,$i-1,$i+2); //get posts from post range ?></td></tr>
     <tr><td colspan="4" align="center"><a href="blogs.php?pageid=<?php echo $link-1; ?>"><<< PREVIOUS</a> <a href="blogs.php?pageid=<?php echo $link+1; ?>">NEXT >>></a></td></tr>
   </table>
   
   <?php } ?>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
