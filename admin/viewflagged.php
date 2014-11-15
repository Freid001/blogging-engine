<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/listflagged.php");
include("../functions/getaccount.php");
include("../pagetop.php");

//Check isset
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
          <th colspan="2">Flagged Blog Posts</th>
        </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext">
		  <?php if (getaccount($db, $user, "level")>0){ //Check account access level
		  listflaggedpost($db); //list flagged posts
		  }else { 
		  echo "<div align='center' class='redtext'>You need level 1 permissions to uses this page!</div>";
		  } ?></td>
        </tr>
      </table>
	  <br />
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">Flagged Gallery Images </th>
        </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext">
		  <?php if (getaccount($db, $user, "level")>0){ //Check account access level
		  listflaggedgallery($db); //listed flagged images
		  }else { 
		  echo "<div align='center' class='redtext'>You need level 1 permissions to uses this page!</div>";
		  } ?></td>
        </tr>
      </table>
	  <br />
	  <table width="95%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2">Flagged Comments</th>
        </tr>
        <tr>
          <td width="30%" height="34" class="twelvetext">
		  <?php if (getaccount($db, $user, "level")>0){ //Check account access level
		  listflaggedcomment($db); //list flagged comments
		  }else { 
		  echo "<div align='center' class='redtext'>You need level 1 permissions to uses this page!</div>";
		  } ?></td>
        </tr>
      </table></td>
      </tr>
  </table>
</div>
</div>
</div>
<?php include("../footer.php"); ?>
</body>
</html>
