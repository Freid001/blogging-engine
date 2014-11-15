<?php
//Get functions
include("connection.php");
include("functions/getpost.php");
include("functions/checkemail.php");
include("pagetop.php");
?>
<div id="main">
<div id="full">
  <?php 
  //Check isseet and check posts
  if(isset($_GET['id'])&&isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['textarea'])){
  $get_id = check($_GET['id']);
  $get_name = check($_POST['name']);
  $get_email = check($_POST['email']);
  $get_comment = check($_POST['textarea']);
  
  if($get_id!=""){
  if($get_email==""){ $get_email = "ANONYMOUS"; } //If anonymous
  ?>
     <table width="100%"><tr><td><div align="center" class="twelvetext">
	 <?php
	 $id = getpost($db, $get_id, "id");
	 //Check variables 
	 if($get_id==$id){
	 if($get_name!=""){
	 if(checkemail($get_email)==true||$get_email=="ANONYMOUS"){ 
	 if($get_comment!=""){
	 //Add to database
	 $query = "INSERT INTO comments(`post`,`name`,`comment`, `email`) VALUES(:post, :name, :comment, :email)";
	 $statement = $db->prepare($query);
	 $statement->execute(array(':post' => $get_id, ':name' => $get_name, ':comment' => $get_comment, ':email' => $get_email));
	 echo "Comment posted!<br /><br /><a href='blogs.php?id=$get_id'>Continue</a>";
	 }else {
	 echo "Please enter a comment!<br /><br /><a href='blogs.php?id=$get_id'>Back</a>";
	 }
	 }else {
	 echo "Please enter a valid email!<br /><br /><a href='blogs.php?id=$get_id'>Back</a>";
	 }
	 }else {
	 echo "Please enter your name!<br /><br /><a href='blogs.php?id=$get_id'>Back</a>";
	 }
	 }else {
	 echo "Please select a valid blog post id!<br /><br /><a href='index.php'>Back</a>";
	 }
	 }else {
	 echo "Please enter a post id!<br /><br /><a href='index.php'>Back</a>";
	 }
	 }
	 ?>
	   </div></td></tr>
    </table>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>