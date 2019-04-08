<?php include "include/req.php";
include "include/link.php";
?>
<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>basic.php</title>
  </head>
  <body>

    <!--NAVBAR-->
    <?php require_once("include/header.php");?>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s " href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s " href="about.php?page=1">About </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s active" href="contact.php?page=1">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link zoomOut delay-2s" href="color.php">Game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="#">Video</a>
      </li>

<?php require_once("include/headerbottom.php");
?>
<!--navbar ends-->
<!--Contact starting-->
<?php
// Initialize variables to null.
$NameError="";
$EmailError="";

//On Submitting form, below function will execute
//Submit Scope starts from here
if(isset($_POST['Submit'])){

 if(empty($_POST["Name"])){
$NameError="*Name is Required";
 }
 else{
$Name=Test_User_Input($_POST["Name"]);
// check Name only contains letters and whitespace
if(!preg_match("/^[A-Za-z\. ]*$/",$Name)){
$NameError="Only Letters and white sapace are allowed";
}
 }
  if(empty($_POST["Email"])){
$EmailError="*Email is Required";
 }
 else{
$Email=Test_User_Input($_POST["Email"]);
// check if e-mail address syntax is valid or not
if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email))
{
$EmailError="Invalid Email Format";
}
}
 
if(!empty($_POST["Name"])&&!empty($_POST["Email"])){
if((preg_match("/^[A-Za-z\. ]*$/",$Name)==true)&&(preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email)==true))
{
$emailTo="contact@lwr.no";
 $subject="Contact Form";
 $body=" Name : ".$_POST["Name"]."
 Email : ".$_POST["Email"].
 "
 Message :: ".$_POST["Comment"];
 $Sender="From: $Email";
     if (mail($emailTo, $subject, $body, $Sender)) {
        echo "<p style='color: green;padding-left:46%;' >Your Message Submitted Successfully </p>";
    } else {
        echo "<p style='color: red;padding-left:46%;' > Something Went Wrong/ Try Again  </p>";

    }

}
}
}//Submit Scope  Ends here
//Function to get and throw data to each of the field final varriable like Name / Gender etc.
function Test_User_Input($Data){
    return $Data;
}

//php code ends here
?>

<div class="container">
    <div class="row">
    <img src="../images/Original.png" style="max-height:400px; max-width:500px;"alt="">

        <div class="col-offset-md-2 col-md-6">
<div class="card">
<div class="card-header">
<h3 style="color:while;">Contact Us</h3>
<small style="color:white">Got a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible</small>
</div>
<div class="card-body">

<form  action="" method="post" >


<input class="input form-control" type="text" Name="Name" value="" placeholder="Name *">
<p style="color:red;"><?php echo $NameError;  ?></p>
<input class="input form-control" type="text" Name="Email" value="" placeholder="Email *">
<p style="color:red;"><?php echo $EmailError; ?></p>

<textarea class="form-control mb-2"Name="Comment" rows="5" cols="25" placeholder="Message"></textarea>

<input class="btn btn-success btn-md" type="Submit" Name="Submit" value="Send Message"> 
</div>
</div>
</form>

</div>

</div>
</div>
<!-- end contact -->
<br>
<?php include "include/footer.php"; ?>

