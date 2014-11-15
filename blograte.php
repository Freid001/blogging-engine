<?php
//Get functions
include("connection.php");
include("functions/getpost.php");
include("pagetop.php");
?>
<div id="main">
<div id="full">
   <?php 
   //Check isset
   if(isset($_GET['id'])&&isset($_GET['type'])){
   $get_id = check($_GET['id']);
   $get_type = check($_GET['type']);
   $get_likes = getpost($db, $get_id, "likes");
   ?>
   
   <table width="100%"><tr><td><div align="center" class="twelvetext">
   <?php
   //If type is like then update +1; 
   if($get_type=="like"){
      $new_like = $get_likes + 1; 
      $query = $db->prepare("UPDATE posts SET likes='$new_like' WHERE id=:id LIMIT 1;");
      $query->execute(array(':id'=>$get_id));
      echo "You like this post!<br /><br /><a href='blogs.php?id=$get_id'>Continue</a>";
	//If type is dislike then update -1; 
   }else if($get_type=="dislike"){
      if($get_likes>0){
         $new_like = $get_likes - 1; 
         $query = $db->prepare("UPDATE posts SET likes='$new_like' WHERE id=:id LIMIT 1;");
         $query->execute(array(':id'=>$get_id));
          echo "You dislike this post!<br /><br /><a href='blogs.php?id=$get_id'>Continue</a>";
   }else {
   echo "You dislike this post!<br /><br /><a href='blogs.php?id=$get_id'>Continue</a>";
   }
  }
 }
?>
</div></td></tr></table>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>