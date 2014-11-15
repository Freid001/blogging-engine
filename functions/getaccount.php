<?php
//Return row of selected input and return from database admin
function getaccount($con, $input, $return){
   $query = $con->prepare("SELECT `$return` FROM admin WHERE username='$input';"); 
   $query->execute(); 
   while ($row = $query->fetch()) {
     if($return=="id"){
       return $row["id"]; 
	 }
	 if($return=="user"){
	   return $row["username"];
	 }
	 if($return=="image"){
	   return  $row["image"];
	 }
	 if($return=="password"){
	   return  $row["password"];
	 }
	 if($return=="level"){
	   return $row["level"];
	 }
    }
}
?>
