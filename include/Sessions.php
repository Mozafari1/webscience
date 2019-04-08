<link rel="stylesheet" href="Animate/Animate.css">
<?php 
 
session_start();
ob_start();
function ErrorMsg(){
    if(isset($_SESSION["ErrorMsg"])){
        $Output="<div class = \"animated fadeOut delay-3s alert alert-danger\">";
        $Output.=htmlentities($_SESSION["ErrorMsg"]);
        $Output.="</div>";
        $_SESSION["ErrorMsg"]=null;
        return $Output;
    }
}
function SuccessMsg(){
    if(isset($_SESSION["SuccessMsg"])){
        $Output="<div class =\"animated fadeOut delay-2s alert alert-success\">";
        $Output.=htmlentities($_SESSION["SuccessMsg"]);
        $Output.="</div>";
        $_SESSION["SuccessMsg"]=null;
        return $Output;
    }
}
?>