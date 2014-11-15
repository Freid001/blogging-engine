<?php
//Return row of selected input and return from database post
function getpost($con, $input, $return){
   $query = $con->prepare("SELECT `$return` FROM posts WHERE id='$input';"); 
   $query->execute(); 
   while ($row = $query->fetch()) {
     if($return=="id"){
	   return $row["id"]; 
	 }
	 if($return=="title"){
	   return $row["title"]; 
	 }
	 if($return=="image"){
	   return  $row["image"];
	 }
	 if($return=="post"){
	   return  $row["post"];
	 }
	 if($return=="author"){
	   return $row["author"];
	 }
	 if($return=="time"){
	   return $row["time"];
	 }
	 if($return=="likes"){
	   return $row["likes"];
	 }
   }
}
?>
