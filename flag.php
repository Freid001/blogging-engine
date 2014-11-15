<?php
//Get functions
include("connection.php");
include("functions/getpost.php");
include("pagetop.php");
?>
<div id="main">
<div id="full">
   <?php 
   //Check if isset
   if(isset($_GET['id'])&&isset($_GET['type'])){
   $get_id = check($_GET['id']);
   $get_type = check($_GET['type']);
   ?>
   
   <table width="100%"><tr><td><div align="center" class="twelvetext">
   <?php
   //If post update db and flag
   if($get_type=="posts"){
   $query = $db->prepare("UPDATE posts SET flag='1' WHERE id=:id LIMIT 1;");
   $query->execute(array(':id'=>$get_id));
   echo "You flagged this post. The site admin will review your flag and respond with appropriate action.<br /><br /><a href='blogs.php?id=$get_id'>Continue</a>";
   }
   //If gallery update db and flag
   if($get_type=="gallery"){
   $query = $db->prepare("UPDATE gallery SET flag='1' WHERE id=:id LIMIT 1;");
   $query->execute(array(':id'=>$get_id));
   echo "You flagged this image. The site admin will review your flag and respond with appropriate action.<br /><br /><a href='gallery.php?id=$get_id'>Continue</a>";
   }
   //If comment update db and flag
   if($get_type=="comments"){
   $query = $db->prepare("UPDATE comments SET flag='1' WHERE id=:id LIMIT 1;");
   $query->execute(array(':id'=>$get_id));
   echo "You flagged this comment. The site admin will review your flag and respond with appropriate action.<br /><br /><a href='blogs.php'>Continue</a>";
   }
   }
   ?>
   </div></td></tr></table>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>