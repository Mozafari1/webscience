<?php include "include/req.php"; ?>

<?php 
if(isset($_POST["Submit"])){
    global $ConnectingDB;
$E_mail = mysqli_real_escape_string ($ConnectingDB, $_POST["Email"]);
$Password =mysqli_real_escape_string ($ConnectingDB, $_POST["Password"]);
if(empty($E_mail)||empty($Password)){
    $_SESSION["ErrorMsg"] = "All Field must be fillet out";
    header("Location: signup.php");
    exit;

}else{
    if(Confirm_Account()){
    $found_account = checkLogin($E_mail, $Password);
        if($found_account){
            $_SESSION["User_Id"] = $found_account['id'];
            $_SESSION["User_Name"] = $found_account['username'];
            $_SESSION["User_Email"] = $found_account['email'];
            if(isset($_POST["Remember"])){
                $ExpireTime = time()+3600;
                setcookie("SettingEmail", $E_mail, $ExpireTime);

            }
            header("Location: userwindow.php");
        }else{
            $_SESSION["ErrorMsg"] = "Invalid password/email";
            header("Location: signup.php");
            exit;
        }
    }
    else{
        $_SESSION["ErrorMsg"] = "Confirm account is required";
            header("Location: signup.php");
            exit;
    }
}

}
include "include/link.php";
?>

    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="css/stylereg.css"> 

</head>
<body>
<?php echo ErrorMsg(); 
    
    ?>
    <form class="box" action="signup.php" method ="post">
    <h1>Login</h1>
    <input type="email" name="Email" placeholder="Email">
    <input type="password" name="Password" placeholder="Password">
    <input type="checkbox" name="Remember">
   
    <input type="submit" name="Submit" value="Login">
    <a href="recover_account.php"> Forgot Password</a> &nbsp;
    <a href="allreg.php">Create Account</a>

    </form>
    <?php include "include/footer.php"; ?>