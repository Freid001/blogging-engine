<?php
//Echo posts in range low to high
function orderposts($con, $low, $high){
   $query = $con->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $low, $high"); 
   $query->execute(); 
   $row = 0;  
   while ($getrow = $query->fetch()) {
      if($row!=3){ //limit row to 3 to prevent extra rows showing 
	     $id = $getrow["id"]; 
		 $title = $getrow["title"]; 
		 $image = $getrow["image"];
		 $post = $getrow["post"];
		 $author = $getrow["author"];
		 $time = $getrow["time"];
		 $post = strip_tags($post); 
		 $post = substr($post, 0, 550); //limit post content to 550 characters
		 echo "<table width='100%' border='0'>
		 <tr>
		 <td width='22%' rowspan='2'><img src='$image' width='250' height='125' border='1'></td>
		 <td width='78%'><h2><b><u>$title</u></b></h2></td>
		 </tr>
		 <tr>
		 <td><span class='twelvetext'>$post...<br /><span class='tentext'>Date: $time, Author: $author</span><br /><br /><a href='/blogs.php?id=$id'>Read More>></a></span></td>
		 </tr>
		 </table>
		 <div id='dash'></div>";
		 $row = $row + 1; 
		}
	}
	if($id==""){
	echo "<table width='100%' border='0'>
		 <tr>
		 <td width='22%' rowspan='2'><img src='assets/side.png' width='250' height='125' border='1'></td>
		 <td width='78%'><h2><b><u>No Post</u></b></h2></td>
		 </tr>
		 <tr>
		    <td><i></i></td> 
		 </tr>
		 </table> <div id='dash'></div>";
	echo "<table width='100%' border='0'>
		 <tr>
		 <td width='22%' rowspan='2'><img src='assets/side.png' width='250' height='125' border='1'></td>
		 <td width='78%'><h2><b><u>No Post</u></b></h2></td>
		 </tr>
		 <tr>
		    <td><i></i></td> 
		 </tr>
		 </table> <div id='dash'></div>";
	echo "<table width='100%' border='0'>
		 <tr>
		 <td width='22%' rowspan='2'><img src='assets/side.png' width='250' height='125' border='1'></td>
		 <td width='78%'><h2><b><u>No Post</u></b></h2></td>
		 </tr>
		 <tr>
		    <td><i></i></td> 
		 </tr>
		 </table> <div id='dash'></div>";
	}
}
?>
