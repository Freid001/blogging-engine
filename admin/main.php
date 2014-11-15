<?php
//Get functions
include("../connection.php");
include("../checkloggedin.php");
include("../functions/rowcount.php");
include("../functions/db.php");
include("../pagetop.php");
?> 
<div id="main">
<div id="full">
<h2 align="center"><img src="<?php echo "$icon" ?>" alt="icon"><u>Admin Panel</u></h2>

<div align="center">
  <table width="85%" border="0">
    <tr>
      <td width="23%" valign="top"><?php include("adminmenu.php"); //Admin menu ?></td>
      <td width="77%" valign="top">
	  
	  <table width="97%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="2"><div align="center">.: Blog Statistics :.</div></th>
        </tr>
        <tr>
          <td bgcolor="#EEEEEE"><h3><strong><u>Blog Statistics</u></strong></h3></td>
          <td width="50%" rowspan="12"><span class="twelvetext"> 
		  <!--Display graphical representation of blog stats-->
          <img src="http://chart.apis.google.com/chart?chtt=Blog+Stats&amp;chts=000000,12&amp;chs=400x250&amp;chf=bg,s,ffffff&amp;cht=p&amp;chd=t:<?php rowcount($db, "posts", "all"); ?>,<?php rowcount($db, "posts", "$user");?>,<?php rowcount($db, "gallery", "all"); ?>,<?php rowcount($db, "gallery", "$user"); ?>,<?php rowcount($db, "comments", "all"); ?>&amp;chl=Total+Posts|My+Posts|Total+Images|My+Images|Total+Comments&amp;chco=ff6600,ffcc00,009900,33cc00,9900cc" alt="Blog Stats"/>         
        <div class='smalltext'>Pie chart image provided by: <a href="http://dexautomation.com/googlechartgenerator.php" target="_blank">Google Charts</a></div></span></td>
        </tr>
        <tr>
          <td width="50%"><span class="twelvetext">Total Blog Posts: <?php rowcount($db, "posts", "all"); //Echo all posts ?></span></td>
          </tr>
        <tr>
          <td><span class="twelvetext">Total Gallery Images: <?php rowcount($db, "gallery", "all"); //Echo all images ?></span></td>
        </tr>
        <tr>
          <td><span class="twelvetext">Total Comments: <?php rowcount($db, "comments", "all"); //Echo all comments ?></span></td>
        </tr>
        <tr>
          <td bgcolor="#EEEEEE"><h3><strong><u>Account Statistics</u></strong></h3></td>
        </tr>
        <tr>
          <td><span class='twelvetext'>My Blog Posts: <?php rowcount($db, "posts", "$user"); //Echo account posts ?></span></td>
        </tr>
        <tr>
          <td><span class='twelvetext'>My Images: <?php rowcount($db, "gallery", "$user"); //Echo account images ?></span></td>
        </tr>
        <tr>
          <td bgcolor="#EEEEEE"><h3><strong><u>Database Statistics</u></strong></h3></td>
        </tr>
        <tr>
          <td><span class="twelvetext">Number Of Accounts: <?php rowcount($db, "admin", "all"); //Echo accounts ?></span></td>
        </tr>
        <tr>
          <td><span class="twelvetext">Number Of Rows: <?php dbrows($db); //Echo db rows ?></span></td>
        </tr>
        <tr>
          <td><span class="twelvetext">Database Size: <?php dbsize($db); //Echo db size ?></span></td>
        </tr>
		<tr>
          <td><br /><br /><br /><br /></td>
        </tr>
      </table><br /><br />
	  
	  <table width="97%" border="0" align="center" class="admintable">
        <tr>
          <th colspan="3"><div align="center">.: Admin Panel Accounts :.</div></th>
        </tr>
        <tr>
          <td width="50%"></td>
          <td width="50%"><?php dbaccounts($db); //Echo accounts?></td>
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
