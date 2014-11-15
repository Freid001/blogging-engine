<?php
//Echo database size
function dbsize($con){
   $index_length = 0; 
   $data_length = 0; 
   $query = $con->prepare("SHOW TABLE STATUS"); 
   $query->execute(); 
   while ($row = $query->fetch()) { 
      $index_length = $index_length + $row["Index_length"]; 
	  $data_length = $data_length + $row["Data_length"];
	}
	$size = $data_length + $index_length; 
	$size = round($size / 1048576, 4);
	$total = 4096; 
	echo "$size MB"; 
}

//Echo database number of rows
function dbrows($con){
    $total_rows = 0; 
	$query = $con->prepare("SHOW TABLE STATUS"); 
	$query->execute(); 
	while ($row = $query->fetch()) { 
	    $total_rows = $total_rows + $row["Rows"]; 
	}
	echo "$total_rows"; 
}

//Echo database total number of accounts and type
function dbaccounts($con){
    $total_rows = 0; 
	$query = $con->prepare("SELECT * FROM admin"); 
	$query->execute(); 
	while ($row = $query->fetch()) { 
	     $username = $row["username"]; 
		 $level = $row["level"]; 
		 echo "<tr><td><span class='twelvetext'>$username</span></td>"; 
		 
		 if($level==0){
		    echo "<td><span class='yellowtext'>POSTER</span></td>";
		}else if($level==1){
		    echo "<td><span class='bluetext'>MODERATOR</span></td>";
		}else if($level==2){
		   echo "<td><span class='redtext'>ADMINISTRATOR</span></td>";
		 }
		 echo "</tr>"; 
		 }
	}
?>
