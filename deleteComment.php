<?php include "include/req.php"; 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); 

    if(isset($_GET["id"])){
        global $ConnectingDB;

        $SearchQueryParameter=mysqli_real_escape_string($ConnectingDB,$_GET['id']);
        $sql = "DELETE FROM comments WHERE id='$SearchQueryParameter'";
        $Execute =mysqli_query($ConnectingDB,$sql);
        if($Execute){
            $_SESSION["SuccessMsg"]="Comment Deleted Successfully";
            Redirect_to("comment.php");
        }else{
            $_SESSION["ErrorMsg"]= "Something went wrong, try again";
            Redirect_to("comment.php");
        }
    }


?>