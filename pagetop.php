<!---HEADER FOR ALL BLOG PAGES--->
<?php
$title = 'My Blog';
$icon = '/assets/icon.gif';
$header = '/assets/sitelogo.png';
$style = '/styles/aero.css';
$welcomeText = 'Welcome to my blog';
//Get style
$query = $db->prepare("SELECT * FROM style"); 
$query->execute(); 
$result = $query->fetchAll( PDO::FETCH_ASSOC );
foreach( $result as $row ){
		
		//Title
		if($row["name"] == 'title' ){
			$title = $row["style"]; 
		}	

		//Icon
		if($row["name"] == 'icon' ){
			$icon = $row["style"]; 
		}	

		//Header
		if($row["name"] == 'header' ){
			$header = $row["style"]; 
		}	

		//CSS
		if($row["name"] == 'css' ){
			$style = $row["style"]; 
		}	

		//Main Text
		if($row["name"] == 'welcomeText' ){
			$welcomeText = $row["style"]; 
		}				
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?php echo "$title"; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo "$style"; ?>" />
  <link rel="shortcut icon" href="/assets/favicon.ico" />
</head>
<body>

<div id="header">
<div align="center"><?php 
//Aero Template
if($style=="/styles/aero.css"&&$header!=""){ echo "<img src='$header' alt='Logo' width='750' height='150'>"; }
if($style=="/styles/aero.css"&&$header==""){ echo "<br /><br /><br /><h1>$title</h1><br /><br /><br />"; }; ?>
</div>
</div>

<div id="menu">
<?php 
//Basix Template
if($style=="/styles/basix.css"&&$header!=""){ echo "<div style='background-image:url($header); background-size:100% 400px; height:400px; background-repeat:repeat-y;'>"; }
?> 
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
			  <div id="livesearch"></div>
			  </td>
            </tr>
          </table>
        </div>
      </form>
  </div>