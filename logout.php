<?php include "include/req.php"; ?>

<?php 
$_SESSION["UserId"]=null;
$_SESSION["FirstName"]=null;
$_SESSION["LastName"]=null;
$_SESSION["Email"]=null;
session_destroy();
Redirect_to("login.php");

?>