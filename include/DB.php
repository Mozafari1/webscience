<?php 
$conn = mysqli_connect("localhost","root","","test");
if(mysqli_connect_errno()){
    echo "Connecting to DB failed: " .mysqli_connect_error();

}
//echo"Connected to DB";
$ConnectingDB = new mysqli("localhost", "root","","test");


?>

