<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../functions/getpost.php");
include("../../functions/getaccount.php");
include("../../pagetop.php");
?>  
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
   <?php
   if(isset($_POST['id'])){
   $id = check($_POST['id']);
      if (getaccount($db, $user, "level")>0 || getaccount($db, $user, "user") == getpost($db, $id, "author")){ 
	  $post_title = strip_tags($_POST['title']);
	  $post_image = strip_tags($_POST['image']);
	  $post_text = strip_tags($_POST['textarea']);
	  
	  //Replace IMG with html post_image tags
	  $post_text = str_replace("[img]", "<img src='", "$post_text");
	  $post_text = str_replace("]", "'>", "$post_text");
	  
	  //Replace LINK with html a href tags
	  $post_text = str_replace("[link'>", "<a href='", "$post_text");
	  $post_text = str_replace("[/link'>", " 'target=_blank'>LINK</a>", "$post_text");
	  
	  //Replace TEXT COLOR space with html color tags
	  $post_text = str_replace("[color:", "<span style='color:", "$post_text");
	  $post_text = str_replace("]", "'>", "$post_text");
	  $post_text = str_replace("[/color'>", "</span>", "$post_text");
	  
	  //Replace TEXT SIZE space with html tag <b>
	  $post_text = str_replace("[size=", "<font size='", "$post_text");
	  $post_text = str_replace("]", "'>", "$post_text");
	  $post_text = str_replace("[/size'>", "</font>", "$post_text");
	  
	  //Replace BOLD space with html tag <b>
	  $post_text = str_replace("[b'>", "<b>", "$post_text");
	  $post_text = str_replace("[/b'>", "</b>", "$post_text");
	  
	  //Replace WHITE SPACE space with html tag <br />
	  $post_text = str_replace("\n", "<br />", "$post_text");
	  
	  //Check post_title
	  if($post_title!=""){
	  
	  //Check URL
	  if($post_image==""){
	  $post_image = "<img src='/assets/side.png'>";
	  }
	  
	  //Check POST
	  if($post_text!=""){
	     //Update data in database
	      $query = $db->prepare("UPDATE posts SET title=:title, image=:image, post=:post WHERE id=:id");
	      $query->execute(array(':title'=>$post_title,':image'=>$post_image,':post'=>$post_text,':id'=>$id));
		  
		  echo "<br />You have successfully updated a blog post!<br /><a href='../main.php'>Continue</a><br /><br />";
		}else {
		  echo "<br /><div class='redtext'>ERROR: Please enter some text in to the post field!</div><br /><a href='editpost.php'>Go Back</a><br /><br />";
		}
	  }else {
	    echo "<br /><div class='redtext'>ERROR: Please enter a post!</div><br /><a href='editpost.php'>Go Back</a><br /><br />";
      }
    }else {
     echo "<br /><div class='redtext'>ERROR: You can not access or edit another accounts post!</div><br /><a href='editpost.php'>Go Back</a><br /><br />";
    }
	}else {
	echo "<br /><div class='redtext'>ERROR: Please select a id!</div><br /><a href='editpost.php'>Go Back</a><br /><br />";
    }
?>
</div>
</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
