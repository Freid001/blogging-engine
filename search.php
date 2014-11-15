<?php
//Get functions
include("connection.php");
include("functions/orderposts.php");
include("pagetop.php");
?>
<div id="main">
<div id="full">
<?php 
//Check isset
if(isset($_GET['search'])){
   $search = check($_GET['search']);
   $title = "NULL";
   
   //echo search criteria
   echo "Search Criteria: $search <br /><br />"; 
   
   //Get posts where like search criteria
   $query = $db->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' OR post LIKE '%$search%' OR author LIKE '%$search%'"); 
   $query->execute(); 
   while ($row = $query->fetch()) { 
     $id = $row["id"]; 
	 $title = $row["title"]; 
	 $post = $row["post"];
	 $image = $row["image"];
	 $post = check($post); 
	 $post = substr($post, 0, 250); 
	 ?>
	    <table width="100%" border="0">
     		<tr>
    			<td width="22%" rowspan="2"><img src='<?php echo "$image"; ?>' width='250' height='125' border='1'></td>
				<td width="78%"><div id="dash-right"></div><h2><b><u><?php echo "$title"; ?></u></b></h2></td>
			</tr>
			<tr>
     			<td><span class="twelvetext"><?php echo "$post..."?><br /><br /><a href="/blogs.php?id=<?php echo "$id"; ?>">Read More>></a></span></td>
			</tr>
	   </table><div id='dash'></div>
	   
	<?php
	}
	
	//Return no results if null
	if($title=="NULL"){ 
	  echo "<br /><div align='center' id='twelvetext' >No results found!</div><br /><br /><br /><br />";
	}
	}else {
	 echo "<br /><br /><br /><br /><br /><br />";
	}
	?>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
