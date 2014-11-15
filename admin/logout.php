<?php
//Get functions
include("../connection.php");
session_destroy(); //End sessions
die ("<meta http-equiv='REFRESH' content='0;url=../admin.php?error=You%20have%20logged%20out!'>");
?>
