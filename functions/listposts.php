<?php
//Get function
include("getaccount.php");

//Echo listed post in the range low to high
function listposts($con, $low, $high, $user){
  if(getaccount($con, $user, "level")>0){
    $query = $con->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $low, $high"); //If admin or mod show all posts
	$query->execute(); 
	$count = 0; //Count and limit to 5
	  while ($row = $query->fetch()) { 
	    if($count!=5){
	       $id = $row["id"]; 
		   $title = $row["title"]; 
		   $author = $row["author"];
		   echo "<a href='../blogs.php?id=$id'>$title</a>, author: $author <br /><br />";
		   $count = $count + 1; 
		   } 
		} 
	}else {
	$query = $con->prepare("SELECT * FROM posts WHERE author='$user' ORDER BY id DESC LIMIT $low, $high"); //Just show accounts posts
	$query->execute(); 
	$count = 0; //Count and limit to 5
	while ($row = $query->fetch()) { 
	  if($count!=5){
	    $id = $row["id"]; 
	    $title = $row["title"]; 
	    echo "<a href='../blogs.php?id=$id'>$title</a><br /><br />";
		$count = $count + 1; 
	  }
	}
  }
}
?>
