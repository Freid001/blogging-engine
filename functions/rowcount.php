<?php
//Echo number of rows in selected table
function rowcount($con, $table, $author){
   if($author=="all"){
      $query = $con->prepare("SELECT * FROM $table;"); 
	  $query->execute();
	  $count = $query->rowCount();
	  echo "$count";
	}else {
	$query = $con->prepare("SELECT * FROM $table WHERE author='$author'"); 
	$query->execute();
	$count = $query->rowCount();
	echo "$count";
	}
}
?>
