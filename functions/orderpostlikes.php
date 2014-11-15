<?php
//Echo top 10 posts with highest likes
function orderpostlikes($con){
   $query = $con->prepare("SELECT * FROM posts ORDER BY likes DESC LIMIT 0, 10"); 
   $query->execute(); 
   while ($row = $query->fetch()) {
      $id = $row["id"];  
	  $title = $row["title"]; 
	  echo "<a href='/blogs.php?id=$id'>$title</a><br /><br />"; 
	}
}
?>
