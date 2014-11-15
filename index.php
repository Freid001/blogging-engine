<?php
//Get functions
include("connection.php");
include("functions/orderposts.php");
include("functions/ordercomments.php");
include("functions/orderimages.php");
include("functions/orderpostlikes.php");
include("pagetop.php");
?>

<div id="main">
<table width="100%">
 <tr>
    <td width="65%" valign="top">
 <?php if($welcomeText!=""){ ?>
    <h2><img src="<?php echo "$icon" ?>" alt="icon" alt="icon" width="20" height="20"> <u>Welcome To <?php echo $title ?></u></h2><?php echo "<span class='twelvetext'>$welcomeText</span>"; //Echo welcome text ?>
	<div id='dash'></div><br />
 <?php } ?>
    <h2><img src="<?php echo "$icon" ?>" alt="icon" alt="icon" width="20" height="20"> <u>Recent Blog Posts</u></h2><?php orderposts($db,0,3); //Get recent 3 posts?><br />
    <h2><img src="<?php echo "$icon" ?>" alt="icon" alt="icon" width="20" height="20"> <u>Recent Gallery Posts</u></h2><?php index_orderimagerow($db,0,3); //Get recent 3 images?>
  </td>
  <td width="1%" valign="top"><div id="dash-right"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div></td>
  <td width="25%" valign="top">
    <h2><img src="<?php echo "$icon" ?>" alt="icon" alt="icon" width="20" height="20"> <u>Recent Comments</u><br /></h2><span class="twelvetext"><?php ordercomments($db,0,3); //Get recent 3 comments?></span><br />
    <h2><img src="<?php echo "$icon" ?>" alt="icon" alt="icon" width="20" height="20"> <u>Popular Blogs</u><br /></h2><span class="smalltext"><?php orderpostlikes($db); //Get top 10 like posts?></span>
  </td>
 </tr>
</table>
</div>
<?php include("footer.php"); ?>
</body>
</html>