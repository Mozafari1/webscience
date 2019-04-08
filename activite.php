<?php include "include/req.php";


global $ConnectingDB;
if(isset($_GET['token'])){
    $TokenFromURL= $_GET['token'];
    $Query = "UPDATE alluser SET active='ON' WHERE token='$TokenFromURL'";
    $Execute =mysqli_query($ConnectingDB, $Query);
    if($Execute){
        $_SESSION["SuccessMsg"] = "Account activited successfully";
        header("Location: signup.php");
        exit;
    }else{
        $_SESSION["ErrorMsg"] = "something went wrong";
        header("Location: allreg.php");
        exit;
    }
}
?>

