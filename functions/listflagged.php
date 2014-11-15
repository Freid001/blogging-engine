<?php
//Echo flagged list for posts
function listflaggedpost($con){
  $query = $con->prepare("SELECT * FROM posts WHERE flag=1"); 
  $query->execute(); 
  $i = 0; 
  while ($row = $query->fetch()) { 
    $id = $row["id"]; 
	$title = $row["title"]; 
	echo "$title <a href='../blogs.php?id=$id'>[VIEW]</a> <a href='edit/editpost.php?id=$id'>[EDIT POST]</a> <a href='deletepost.php?id=$id'>[DELETE POST]</a> <a href='unflag.php?id=$id&type=posts'>[UNFLAG]</a><br /><br />";
	$i = $i + 1;
	}if($i==0){
	echo "<i>No flagged content!</i>";
    }
}

//Echo flagged list for comments
function listflaggedcomment($con){
  $query = $con->prepare("SELECT * FROM comments WHERE flag=1"); 
  $query->execute(); 
  $i = 0; 
  while ($row = $query->fetch()) { 
    $id = $row["id"]; 
	$post = $row["post"]; 
	$comment = $row["comment"]; 
	echo "$comment <a href='../blogs.php?id=$post'>[VIEW]</a> <a href='../deletecomment.php?id=$id'>[DELETE COMMENT]</a> <a href='unflag.php?id=$id&type=comments'>[UNFLAG]</a><br /><br />";
	$i = $i + 1; 
	}if($i==0){
	echo "<i>No flagged content!</i>";
	}
}

//Echo flagged list for gallery images
function listflaggedgallery($con){
  $query = $con->prepare("SELECT * FROM gallery WHERE flag=1"); 
  $query->execute(); 
  $i = 0; 
  while ($row = $query->fetch()) { 
    $id = $row["id"]; 
	$tag = $row["tag"]; 
	echo "$tag <a href='../gallery.php?id=$id'>[VIEW]</a> <a href='gallery/deleteimage.php?id=$id'>[DELETE IMAGE]</a> <a href='unflag.php?id=$id&type=gallery'>[UNFLAG]</a><br /><br />";
	$i = $i + 1; 
	}if($i==0){
	echo "<i>No flagged content!</i>";
	}
}
?>
