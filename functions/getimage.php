<?php
//Return row of selected input and return from database gallery
function getimage($con, $input, $return){
   $query = $con->prepare("SELECT * FROM gallery WHERE id='$input';"); 
   $query->execute(); 
   while ($row = $query->fetch()) {
     if($return=="id"){
	   return $row["id"]; 
	 }
	 if($return=="url"){
	   return $row["image"]; 
	 }
	 if($return=="tag"){
	   return  $row["tag"];
	 }
	 if($return=="author"){
	   return  $row["author"];
	 }
	 if($return=="time"){
	   return  $row["time"];
	 }
    }
}
?>
