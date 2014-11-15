<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/listposts.php");
include("../pagetop.php");

//Check pageid isset
if(isset($_GET['pageid'])&&$_GET['pageid']>0){
  $i = check($_GET['pageid']);
  $link = check($_GET['pageid']);
  $i = 5 * $i; 
  $i = $i - 4; 
  }else {
  $i = 1; 
  $link = 1; 
} 
?>
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>
<div align="center">
  <table width="85%" border="0">
    <tr>
      <td width="23%" valign="top"><?php include("adminmenu.php"); //Admin menu ?></td>
      <td width="77%" valign="top">
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">All Posts</th>
        </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext"><?php listposts($db, $i-1, $i+4, $user); //List post for this account ?></td>
        </tr>
		<tr><td align="center"><a href="myposts.php?pageid=<?php echo $link-1; ?>"><<< PREVIOUS</a> <a href="myposts.php?pageid=<?php echo $link+1; ?>">NEXT >>></a></td></tr>
      </table></td>
      </tr>
  </table>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
