<?php
//Check email and return true or false
//Regular Expression REFERENCE: http://www.w3schools.com/php/filter_validate_email.asp
function checkemail($email){
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
return true; 
}else {
return false;
}
}
?>
