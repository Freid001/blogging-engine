<?php
//Echo listed comments in the range low to high
function ordercomments($con, $low, $high){
  $query = $con->prepare("SELECT * FROM comments ORDER BY id DESC LIMIT $low, $high"); 
  $query->execute(); 
  while ($row = $query->fetch()) {
    $id = $row["post"];  
	$name = $row["name"]; 
	$comment = $row["comment"];
	$date = $row["date"];
	$comment = substr($comment, 0, 100); //Limit comment text to 100
	echo "<table width='100%' border='0'><tr>
	<b>$name: </b>$comment...<br /><b>$date</b><br /><a href='/blogs.php?id=$id'>Read more>></a>
	</tr></table>
	<div id='dash'></div>";
	}
	if($id==""){
	echo "<i>No Comments!</i>";
	}
}
?>
