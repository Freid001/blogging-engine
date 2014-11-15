<?php
//Get functions
include("connection.php");
include("functions/orderposts.php");
include("functions/orderimages.php");
include("functions/getimage.php");
include("pagetop.php");
?>
<div id="main">
<table width="100%">
  <?php 
  //Check isset and get variables
  if(isset($_GET['id'])){
  $get_post = check($_GET['id']);
  $url = getimage($db, $get_post, "url");
  echo "<h2><b><img src='$icon' alt='icon'> <u>Gallery</u></b></h2>"; ?>
     
	 <table width="100%" border="0">
	 <tr>
    	<td width="3%" rowspan="11"><img class="largeimage" src="<?php echo "$url"; ?>" alt="gallery image" border='1'></td>
	 </tr>
	 <tr>  
    	 <td width="97%"><div class="twelvetext"><?php echo "<b>Tag:</b> "; echo getimage($db, $get_post, "tag"); ?></div></td>
	</tr>
	<tr>  
    	<td><div id="dash"></div></td>
    </tr>
	<tr>  
    	<td><div class="twelvetext"><?php echo "<b>Added By:</b> "; echo getimage($db, $get_post, "author"); ?></div></td>
	</tr> 
	<tr>  
    	<td><div id="dash"></div></td>
	</tr>
	<tr> 
    	<td><div class="twelvetext"><?php echo "<b>Date:</b> "; echo getimage($db, $get_post, "time"); ?></div></td>
	</tr>
	<tr>  
    	<td><div id="dash"></div></td>
	</tr>
	<tr> 
    	<td><div class="twelvetext"><?php echo "<b> Image Reference:</b> <a href='$url' target='_blank'> $url </a>"; ?></div></td>
	</tr>
	<tr>
    	<td><div id="dash"></div></td>
	</tr>
	<tr>
    	<td><a href="flag.php?<?php echo "id=$get_post&&type=gallery" ?>">[Flag Image]</a></td>
	</tr>
	<tr>  
	    <td><br /><br /><br /><br /></td>
    </tr>
	<tr>  
    	<td></td>
	</tr>
	<tr>  
    	<td></td>
    </tr>
    </table>
	
	<?php 
	}else {
	//Check page id and set image range
	if(isset($_GET['pageid'])&&$_GET['pageid']>0){
	$i = check($_GET['pageid']);
	$link = check($_GET['pageid']);
	$i = 9 * $i; 
	$i = $i - 8; 
	}else {
	$i = 1; 
	$link = 1; 
	}
	$low = $i-1;
	$high = $i+8;
	?>
	
	<h2><img src="<?php echo "$icon" ?>" alt="icon"> <u>Recent Gallery Posts</u><br></h2>
	<?php orderimagerow($db, $low, $high); //Get image range
	echo "Image range: $low to $high"; ?>
	
	<table width="100%" border="0">
	<tr><td colspan="4" align="center"><a href="gallery.php?pageid=<?php echo $link-1; ?>"><<< PREVIOUS</a> <a href="gallery.php?pageid=<?php echo $link+1; ?>">NEXT >>></a></td></tr>
	</table><br />
	<?php } ?>
	
</table>
</div>
<?php include("footer.php"); ?>
</body>
</html>
