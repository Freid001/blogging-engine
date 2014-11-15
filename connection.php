<?php
//Set Session Start
include("dbcon.php");
session_start(); 

//Connect to database
if(function_exists('getdb')){
$db = getdb();
}else {
echo "<meta http-equiv='REFRESH' content='0;url=/installation.php'>";
}

//Set username
if(isset($_SESSION['username'])){
$user = $_SESSION['username']; 
}

//Check for bad characters and remove or escape. 
function check($input){
$input = strip_tags($input);
$input = mysql_escape_string(addslashes($input));
return $input; 
}
?>
