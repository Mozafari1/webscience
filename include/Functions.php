<?php require_once("include/DB.php"); ?>


<?php 

function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}

function Password_Encryption($Password){
    $BlowFish_Hash_Format = "$2y$10$";
        $Salt_length=255;
        $Salt =Generate_Salt($Salt_length);
        $Formating_Blowfish_With_Salt= $BlowFish_Hash_Format .$Salt;
        $Hash =crypt($Password,$Formating_Blowfish_With_Salt);
        return $Hash;
}
function Generate_Salt($lenght){
    $Unique_Random_String =md5(uniqid(mt_rand(109890,1000000000), true));
    $Base64_String = base64_encode($Unique_Random_String);
    $Modified_Base64_String =str_replace('+', '.', $Base64_String);
    $Salt= substr($Modified_Base64_String,0, $lenght);
    return $Salt;
}
function Password_Check($Password, $Existing_Hash){
$Hash = crypt($Password, $Existing_Hash);
if($Hash==$Existing_Hash){
    return true;
}else{
    return false;
}
}
function CheckUserNamenDB($Email){
global $ConnectingDB;
$stmt = "SELECT * FROM admins WHERE email='$Email'";
$Result=mysqli_query($ConnectingDB,$stmt);
if(mysqli_num_rows($Result)>0){
    return true;
}else{
    return false;
}
}

function Login_Check($Email,$Password){
    global $ConnectingDB;
    $stmt ="SELECT * FROM admins WHERE email='$Email'";
    //$stmt->bindValue(':userName',$UserName);
    $Execute = mysqli_query($ConnectingDB,$stmt);
    //$Result =mysqli_fetch_assoc($Execute);
    if($Result=mysqli_fetch_assoc($Execute)){
        if(Password_Check($Password, $Result["password"])){
        return $Result;
        }
    }else{
        return null;
    }
}

// Check all User name in DB
function CheckAllUserNamenDB($E_mail){
    global $ConnectingDB;
    $stmt = "SELECT * FROM alluser WHERE email='$E_mail'";
    $Result=mysqli_query($ConnectingDB,$stmt);
    if(mysqli_num_rows($Result)>0){
        return true;
    }else{
        return false;
    }
    }
    // check login al user 
    function checkLogin($E_mail, $Password){
        global $ConnectingDB;
        $Query = "SELECT * FROM alluser WHERE email='$E_mail'";
        $Execute = mysqli_query($ConnectingDB, $Query);
        if($User=mysqli_fetch_assoc($Execute)){
            if(Password_Check($Password, $User["password"])){
                return $User;
            }
        }
        return null;
    }
// Configoration
function Confirm_Account(){
    global $ConnectingDB;
    $Query = "SELECT * FROM alluser WHERE active='ON'";
    $Execute = mysqli_query($ConnectingDB, $Query);
    if(mysqli_num_rows($Execute)>0){
        return true;
    }else{
        return false;
    }
}

// Cookie
function Signin(){
    if(isset($_SESSION["User_Id"])||isset($_COOKIE["SettingEmail"])){
        return true;
    }
}


function Login(){
    if(isset($_SESSION["UserId"])){
	return true;
    }
}
 function Confirm_Login(){
    if(!Login()){
	$_SESSION["ErrorMsg"]="Login Required! ";
	Redirect_to("login.php");
    }
    
 }
 function Con_Log(){
    if(!Signin()){
	$_SESSION["ErrorMsg"]="Login Required! ";
	Redirect_to("signup.php");
    }
    
 }
function TotalPosts(){
global $ConnectingDB;
$stmt="SELECT COUNT(*) FROM posts";
$stmt= mysqli_query($ConnectingDB,$stmt);
$TotalRows = $stmt->fetch_assoc();
$TotalPosts = array_shift($TotalRows);
echo $TotalPosts;
}
function TotalCatagory(){ 
global $ConnectingDB;
$stmt="SELECT COUNT(*) FROM category";
$stmt= mysqli_query($ConnectingDB,$stmt);
$TotalRows = $stmt->fetch_assoc();
$TotalCatagory = array_shift($TotalRows);
echo $TotalCatagory;
}
function TotalAdmins(){
global $ConnectingDB;
$sql="SELECT COUNT(*) FROM admins";
$stmt=mysqli_query($ConnectingDB,$sql);
$TotalRows = $stmt->fetch_assoc();
$TotalAdmins = array_shift($TotalRows);
echo $TotalAdmins;
}
function TotalComments(){
global $ConnectingDB;
$sql="SELECT COUNT(*) FROM comments";
$stmt=mysqli_query($ConnectingDB,$sql);
$TotalRows = $stmt->fetch_assoc();
$TotalComments = array_shift($TotalRows);
echo $TotalComments;
}

function ApproveCommentsAccordingtoPost($PostId){
    global $ConnectingDB;
    $sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
    $stmtApprove =mysqli_query($ConnectingDB,$sqlApprove);
    $RowsTotal = $stmtApprove->fetch_assoc();
    $Total = array_shift($RowsTotal);
    return $Total;
  }
   
function DisApproveCommentsAccordingtoPost($PostId){
    global $ConnectingDB;
    $sqlDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
    $stmtDisApprove =mysqli_query($ConnectingDB,$sqlDisApprove);
    $RowsTotal = $stmtDisApprove->fetch_assoc();
    $Total = array_shift($RowsTotal);
    return $Total;
  }

?>