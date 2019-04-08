<?php include "include/req.php"; ?>

<?php 
global $ConnectingDB;
if(isset($_POST["Submit"])){
$UserName =mysqli_real_escape_string($ConnectingDB, $_POST["Username"]);
$E_mail = mysqli_real_escape_string ($ConnectingDB, $_POST["Email"]);
$Password =mysqli_real_escape_string ($ConnectingDB, $_POST["Password"]);
$ConrfimPassword =mysqli_real_escape_string ($ConnectingDB, $_POST["ConfirmPassword"]);
$Token = bin2hex(openssl_random_pseudo_bytes(40));
if(empty($UserName)&&empty($E_mail)&&empty($Password)&&empty($ConrfimPassword)){
    $_SESSION["ErrorMsg"] = "All Field must be fillet out";
    Redirect_to("allreg.php");
    
}elseif($Password!==$ConrfimPassword){
    $_SESSION["ErrorMsg"] = "Password didn't match together";
    Redirect_to("allreg.php");
    
}
elseif(strlen($Password)<4){
    $_SESSION["ErrorMsg"] = "Password must be greater then 4";
    Redirect_to("allreg.php");
    
}elseif(CheckAllUserNamenDB($E_mail)){
    $_SESSION["ErrorMsg"] = "Email is already, try someone else";
    Redirect_to("allreg.php");
    
}else{
    
    $Hashed_Password = Password_Encryption($Password);
$Query = "INSERT INTO alluser (username, email, password, token, active)
 VALUES ('$UserName', '$E_mail', '$Hashed_Password', '$Token', 'OFF')";
$Execute = mysqli_query($ConnectingDB, $Query);
if($Execute){
    $subject = "Confirm your account";
    $txt = "Hi".$UserName. "Here is the link to confirm your account'.$Token'";
    $headers = "From: lwr@lwr.no";
    if(mail($E_mail, $subject, $txt, $headers)){
            $_SESSION["ErrorMsg"] = "Check your email for activiting your account";
                Redirect_to("login.php");
                
    }else{
        $_SESSION["ErrorMsg"] = "Something went worng";
            Redirect_to("allreg.php");
            
    }
}else{
    $_SESSION["ErrorMsg"] = "Something went wrong";
    Redirect_to("allreg.php");
    
}
}
}

include "include/link.php";
?>

    <link rel="stylesheet" href="css/stylereg.css"> 
 
</head>
<body>
<?php echo ErrorMsg(); 
    
    ?>
    <form class="box" action="allreg.php" method ="post">
    <h1>Sign Up</h1>
    <input type="text" name="Username" placeholder="Username">
    <input type="email" name="Email" placeholder="Email">

    <input type="password" name="Password" placeholder="Password">
    <input type="password" name="ConfirmPassword" placeholder="Confirm Password">
    <input type="submit" name="Submit" value="Sign Up">
    <a href="signup.php">Sign In</a>
    &nbsp;
    <a href="recover_account.php">Forgot Password</a>

    </form>
 
    
<footer class="footer">
  <div style="height: 1.2px; background: red;"></div>

<?php include "include/footer.php";