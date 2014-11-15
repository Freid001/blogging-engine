<?php
//Get functions
include("connection.php");
include("checkloggedin.php");
include("functions/getaccount.php");
include("pagetop.php");

//Check isset and set get_post
if(isset($_GET['id'])){
$get_post = check($_GET['id']);
}else {
$get_post = 0; 
}
?>
<div id="main">
  <div id="full"> 
    <span class="twelvetext">
	  <?php 
	    //If access level high enough
	    if (getaccount($db, $user, "level")>0){  
		   if($get_post!=0){
		      //Update db and delete comment
			  $query = $db->prepare("DELETE FROM comments WHERE id=:id LIMIT 1;");
              $query->execute(array(':id'=>$get_post));
			  echo "<div align='center'><br />Comment deleted! (id: $get_post)</div><meta http-equiv='REFRESH' content='1;url=/index.php'></HEAD><br /><br />";
		    }
		  }else {
		     echo "<div align='center' class='redtext'>You need level 1 permissions to uses this page!</div>";
		  }?>
	    </span>
	</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
