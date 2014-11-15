<?php
//Get functions
include("../connection.php");
include("../functions/getpost.php");
include("../pagetop.php");
?>
<div id="main">
<div id="full">
   <?php 
   //Check isset
   if(isset($_GET['id'])&&isset($_GET['type'])){
   $get_id = check($_GET['id']);
   $get_type = check($_GET['type']);
   ?>
   
   <table width="100%"><tr><td><div align="center" class="twelvetext">
   <?php
   //If post update db and flag
   if($get_type=="posts"){
      $query = $db->prepare("UPDATE posts SET flag='0' WHERE id=:id LIMIT 1;");
      $query->execute(array(':id'=>$get_id));
       echo "You have unflagged this post. <br /><br /><a href='viewflagged.php'>Continue</a>";
   }
   
   //If gallery update db and flag
   if($get_type=="gallery"){
      $query = $db->prepare("UPDATE gallery SET flag='0' WHERE id=:id LIMIT 1;");
      $query->execute(array(':id'=>$get_id));
      echo "You have unflagged this image.<br /><br /><a href='viewflagged.php'>Continue</a>";
   }
   
   //If comments update db and flag
   if($get_type=="comments"){
      $query = $db->prepare("UPDATE comments SET flag='0' WHERE id=:id LIMIT 1;");
      $query->execute(array(':id'=>$get_id));
      echo "You have unflagged this comment.<br /><br /><a href='viewflagged.php'>Continue</a>";
   }
}
?>
</div></td></tr></table>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>