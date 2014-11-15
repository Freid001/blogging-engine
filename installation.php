<?php
//Check function
function check($input){
$input = strip_tags($input);
$input = mysql_escape_string(addslashes($input));
return $input; 
}

//Get Post data
$id = check($_GET['id']);
$step = check($_GET['step']);
$dbhost = check($_POST['dbhost']);
$dbname = check($_POST['dbname']);
$dbusername = check($_POST['dbuser']);
$dbpassword = check($_POST['dbpassword']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Blog Installation</title>
<link rel="stylesheet" type="text/css" href="/styles/basix.css" />
<link rel="shortcut icon" href="/assets/favicon.ico" />
<style type="text/css">
<!--
.style3 {color: #CCCCCC}
-->
</style>
</head>
<body>
<div id="menu">
  <div style="background-image:url(/assets/sitelogo.png); background-size:100% 300px; height:300px; background-repeat:repeat-y;">
    <ul>
      <li id="active"><a href="/index.php">Home</a></li>
      <li><a href="/blogs.php">Blogs</a></li>
      <li><a href="/gallery.php">Gallery</a></li>
      <li><a href="/search.php">Search</a></li>
      <li><a href="/admin.php"> <img src="/assets/key.png" alt="password" width="12" height="12" border="0"> Admin Panel</a></li>
    </ul>
  </div>
</div>
<div id="search">
  <form name="searchform" method="get" action="/search.php">
    <div align="center">
      <table width="100%" border="0">
        <tr>
          <td width="100%" align="center"><input name="search" type="text" class="search" size="60" />
            <input type="submit" name="Submit" value="Search" onKeyUp="showResult(this.value)">
            <div id="livesearch"></div></td>
        </tr>
      </table>
    </div>
  </form>
</div>
<div id="main">
  <div id="full">
    <h2 align="center"><img src="assets/icon.gif" alt="icon" width="20" height="20"> Installation</h2>
    <div align="center">
	  <br>
      STEP 1 - 
	  <?php if($step<2){ echo "<span class='style3'>STEP 2</span>"; }else { echo "STEP 2 "; }?>
	  -
	  <?php if($step<3){ echo " <span class='style3'>COMPLETED</span>"; }else { echo "INSTALLATION COMPLETED"; }?>
	  <br>
<?php
if($id==1){
$file = "dbcon.php"; 
if(file_put_contents($file, "test")){
file_put_contents($file, "<?php function getdb() { return new PDO('mysql:host=$dbhost; dbname=$dbname', '$dbusername', '$dbpassword'); };?>");


echo "<br /><b>Database Connection Details</b><br />Host: $dbhost <br /> dbname: $dbname <br /> dbusername: $dbusername <br /> dbpassword: *******<br />"; 
echo "<br /><b>Testing & Table Configuration</b>"; 

include("dbcon.php");

try {
    $db = getdb();
	
	//echo "$db"; 
    echo "<br />Database connection test: <span class='style2'>Passed</span>";
} catch (PDOException $e) {
    echo "<br />Database connection test: <span class='style1'>Failed</span> <br /><br />";
    print "Error Message: " . $e->getMessage() . "<br/><br/><a href='installation.php'>Go Back</a><br/><br/>";
	die (""); 
}


$db = getdb();

//Import DB
$query = "CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ";
$query = $db->prepare($query);
$query->execute(); 

$query = "INSERT INTO `admin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'ab6c3191a312ff37055953c31070bbcc', 2)";
$query = $db->prepare($query);
$query->execute(); 

$query = "CREATE TABLE IF NOT EXISTS `style` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `style` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ";
$query = $db->prepare($query);
$query->execute(); 

//Add images
$query = "INSERT INTO `style` (`id`, `name`, `style`) VALUES
(1, 'title', 'My Blog')";
$query = $db->prepare($query);
$query->execute(); 

$query = "INSERT INTO `style` (`id`, `name`, `style`) VALUES
(2, 'header', '/assets/sitelogo.png')";
$query = $db->prepare($query);
$query->execute(); 

$query = "INSERT INTO `style` (`id`, `name`, `style`) VALUES
(3, 'icon', '/assets/icon.gif')";
$query = $db->prepare($query);
$query->execute(); 

$query = "INSERT INTO `style` (`id`, `name`, `style`) VALUES
(4, 'css', '/styles/aero.css')";
$query = $db->prepare($query);
$query->execute(); 

$query = "CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8";
$query = $db->prepare($query);
$query->execute(); 

$query = "CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `tag` text NOT NULL,
  `author` varchar(70) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2";
$query = $db->prepare($query);
$query->execute(); 

$query = "CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(75) NOT NULL,
  `image` text NOT NULL,
  `post` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likes` int(11) DEFAULT NULL,
  `flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18";
$query = $db->prepare($query);
$query->execute(); 

$query = $db->prepare("SELECT * FROM admin"); 
$query->execute(); 
while ($row = $query->fetch()) { 
$check = $row["username"];
}

if($check=="admin"){
echo "<br />Importing tables: <span class='style2'>Completed</span><br /><br />";
}else {
echo "<br />Importing tables: <span class='style1'>Failed</span><br /><br />";
die ("Error Message: Unknown error, contact hosting provider!<br/><br/><a href='installation.php'>Go Back</a><br/><br/>");
}

echo "<b>Default Admin Account Details</b><br />Username: admin<br />Default Password: 0000 <b>(It is recommended that you change this once login!)</b>";

echo "<br /><br /><a href='/installation.php?step=3'>Continue</a><br /><br/>";


}else {
echo "An error has occurred! Your hosting provider may not support PHP 5!";
} 
}else {
?>
        <table width="90%" border="0" align="center">
          <tr>
		  <?php if($step=="3"){?>
            <td colspan="2"><div align="center">
                <h2><strong><img src="assets/icon.gif" alt="icon" width="20" height="20" /> INSTALLATION COMPLETED</strong></h2>
              </div></td>
          </tr>
          <tr>
            <td height="26" colspan="2"><div align="center"><span class="twelvetext">
			You can now login to your admin account! <br><br>
            <b>Default Admin Account Details</b><br />Username: admin<br />Default Password: 0000 <b><br />(It is recommended that you change this once login!)</b><br /><br />
			<a href="/admin.php"> LOGIN TO ADMIN ACCOUNT </a>
                <br /><br /><div id='dash'></div><br />
				</span></div></td>
          </tr>
		  <? } if($step==""){?>
            <td colspan="2"><div align="center">
                <br /><h2><strong><img src="assets/icon.gif" alt="icon" width="20" height="20" /> Terms Of Use</strong></h2>
              </div></td>
          </tr>
          <tr>
            <td colspan="2"><div align="center"><span class="twelvetext">
			<b>Disclaimer</b><br /> 
			1: This blogging engine was designed, coded and built by Freid Creations(Fraser Reid) - Copyright 2013.<br /> 
			2: The code for this blogging engine is in the public domain, anyone may use this code but assumes responsibility. <br /> 
			3.1: The contents of this blogging engine is the responsibility of the owner assigned during the installation process.<br /> 
			3.2: The owner may reproduce and distribute copies of this blogging engine however: he/she must ensure that any given recipients of the blogging engine agree to these terms.  <br /> 
			3.3: The owner cannot distribute this blogging engine for profit purposes. <br /> 
			3.4: The owner can make or give permission for modifications to the blogging engine, it is the responsibility of the owner to ensure that all copyright is accounted for. <br /> 
			4: Freid Creations(Fraser Reid) cannot be held responsible for the actions of the blogging engine owner or code usage. <br /> 
			5: Freid Creations(Fraser Reid) cannot be held responsible for the loss of any data due to a defect or flaw in the blogging engine.<br /> 
			6: Freid Creations(Fraser Reid) reserves the right to change or modify this disclaimer at any time without warning or notifying users. <br /> 
				 It is the responsibility of the blogging owner to be: aware of and compliance with the disclaimer at all times.<br /> 
			</span></div></td>
          </tr>
          <tr>
            <td height="26" colspan="2"><div align="center">
			    <form name="form1" method="post" action="installation.php?step=2">
                <input name="submit" type="submit" value="I Agree To The Terms Of Use">
				</form>
                <br /><br /><div id='dash'></div><br />
				</div></td>
          </tr>
		  <? }if($step==2){ ?>
		      <td height="138" colspan="2"><div align="center"><span class="twelvetext">Before  you can get started you will first need to install a database. You will need to enter  your database connection details below (hostname, db name, db username and db password). <br />
                Contact  your hosting provider if you are unsure how to do this. <br />
                <br />
                <strong>System requirements:</strong><br />
                * PHP version 5+<br />
                * MYSQL version 5.1+ <br />
                <br />
                </span></div>
              <div id='dash'></div></td>
          </tr>
          <tr>
		   <form name="form2" method="post" action="installation.php?id=1&step=2">
            <td colspan="2"><div align="center">
                <h2><strong><img src="assets/icon.gif" alt="icon" width="20" height="20" /> Database Installation</strong></h2>
              </div></td>
          </tr>
          <tr>
            <td width="50%"><p align="right" class="twelvetext">Host Name: </p></td>
            <td width="50%"><input name="dbhost" type="text" id="post_dbhost"></td>
          </tr>
          <tr>
            <td><div align="right" class="twelvetext">DB Name: </div></td>
            <td><input name="dbname" type="text" id="post_dbname" /></td>
          </tr>
          <tr>
            <td><p align="right" class="twelvetext">DB Username : </p></td>
            <td><input name="dbuser" type="text" id="post_dbuser"></td>
          </tr>
          <tr>
            <td><p align="right" class="twelvetext">DB Password: </p></td>
            <td><input name="dbpassword" type="password" id="post_dbpassword" /></td>
          </tr>
          <tr>
            <td height="26" colspan="2"><div align="center">
                <input name="submit" type="submit" value="Install Database">
                <br /><br /><div id='dash'></div><br />
				</div></td>
          </tr>
		  <? } ?>
        </table>
      </form>
      <?php } ?>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
