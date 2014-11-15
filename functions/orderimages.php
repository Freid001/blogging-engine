<?php
//Echo listed images in the range low to high
function orderimagerow($con, $low, $high){
  $query = $con->prepare("SELECT * FROM gallery ORDER BY id DESC LIMIT $low, $high"); 
  $query->execute(); 
  $col = 0; 
  $row = 0;  
  echo "<table width='100%' border='0'><tr>"; //Start Table
  while ($getrow = $query->fetch()) { 
    if($row!=9){ //Check row to prevent extra rows from showing
	  $id = $getrow["id"]; 
	  $url = $getrow["image"]; 
	  echo "<td align='center'><a href='gallery.php?id=$id'><img class='smallimage' src='$url' border='1'></a></td>";
	    if($col==2){ //Check col to prevent extra cols from showing
		echo "</tr><tr>";
		$col = 0;
		}else {
		$col = $col + 1; 
		}
		$row = $row + 1; 
		}
	}
	echo "</table><br /><br />"; //End Table
}

//Echo listed images in range 0 to 4 for index page
function index_orderimagerow($con){
  $query = $con->prepare("SELECT * FROM gallery ORDER BY id DESC LIMIT 0, 4"); 
  $query->execute(); 
  echo "<table width='100%' border='0'><tr>";
  while ($row = $query->fetch()) { 
     $id = $row["id"]; 
	 $url = $row["image"]; 
	 echo "<td><a href='gallery.php?id=$id'><img class='smallimage'  src='$url' border='1'></a></td>";
    }
	if($id==""){
	echo "<td><img class='smallimage' src='assets/side.png' border='1'></td>";
	echo "<td><img class='smallimage' src='assets/side.png' border='1'></td>";
	echo "<td><img class='smallimage' src='assets/side.png' border='1'></td>";
	}
    echo "</tr><tr>";
	echo "<td><a href='gallery.php'>Go to Gallery>>></a></td>"; 
	echo "</tr></table>"; 
}
?>

