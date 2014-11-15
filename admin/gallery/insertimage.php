<?php
//Get functions
include("../../connection.php");
include("../../checkloggedin.php");
include("../../pagetop.php");
?> 
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2><br>

<div align="center">
<?php
$post_url = check(strtolower ($_POST['url']));
$post_tag = check(strtolower ($_POST['tag']));

//Check isset
if(isset($post_url)&&isset($post_tag)&&$post_url!=""&&$post_tag!=""){
   //Add data to database
   $query = "INSERT INTO gallery(`image`,`tag`,`author`) VALUES(:url, :tag, :author)";
   $query = $db->prepare($query);
   $query->execute(array(':url' => $post_url, ':tag' => $post_tag, ':author' => $user));
   echo "<br />You have successfully added a image to the gallery!<br /><a href='../main.php'>Continue</a><br /><br />";
}else {
 echo "<br /><div class='redtext'>ERROR: Please enter a url and tag line!</div><br /><a href='addimage.php'>Go Back</a><br /><br />";
}
?>
</div>
</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
