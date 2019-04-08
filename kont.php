<?php include "include/req.php";
include "include/link.php";
?>


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
$GenderError="";
$WebsiteError="";
//On Submitting form, below function will execute
//Submit Scope starts from here
if(isset($_POST['Submit'])){

 if(empty($_POST["Name"])){
$NameError="Name is Required";
 }
 else{
$Name=Test_User_Input($_POST["Name"]);
// check Name only contains letters and whitespace
if(!preg_match("/^[A-Za-z\. ]*$/",$Name)){
$NameError="Only Letters and white sapace are allowed";
}
 }
  if(empty($_POST["Email"])){
$EmailError="Email is Required";
 }
 else{
$Email=Test_User_Input($_POST["Email"]);
// check if e-mail address syntax is valid or not
if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email))
{
$EmailError="Invalid Email Format";
}
}
  if(empty($_POST["Gender"])){
$GenderError="Gender is Required";
 }
 else{
$Gender=Test_User_Input($_POST["Gender"]);

}
  if(empty($_POST["Website"])){
$WebsiteError="Website is Required";
 }
 else{
$Website=Test_User_Input($_POST["Website"]);
 // check Website address syntax is valid or not

if(!preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]*/",$Website)){
$WebsiteError="Invalid Webside Address Format";
}
}
if(!empty($_POST["Name"])&&!empty($_POST["Email"])&&!empty($_POST["Gender"])&&!empty($_POST["Website"])){
if((preg_match("/^[A-Za-z\. ]*$/",$Name)==true)&&(preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email)==true)&&(preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]*/",$Website)==true))
{
/*echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Gender: {$_POST["Gender"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>"; */
$emailTo="contact@lwr.no";
 $subject="Contact Form";
 $body=" Name : ".$_POST["Name"]."
 Email : ".$_POST["Email"].
 "
 Gender : ". $_POST["Gender"]."
 Website : ".$_POST["Website"].
 "
 Message :: ".$_POST["Comment"];
 $Sender="From:contact@lwr.no";
     if (mail($emailTo, $subject, $body, $Sender)) {
                echo "<h4>".$_POST['Name'].",  Your Message Submitted Successfully</h2> <br>";
                    } else {
                echo "<h4>".$_POST['Name']." Something Went Wrong :/ Try Again !</h2> <br>";
                    }

}else{
    echo '<span class="Error">* Please Complete & Correct your Form then Try Again*<br><br></span>';
}
}
}//Submit Scope  Ends here
//Function to get and throw data to each of the field final varriable like Name / Gender etc.
function Test_User_Input($Data){
    return $Data;
}

//php code ends here
?>

<style type="text/css">
body{
    max-width: auto;
    max-height:auto;
}
input[type="text"],input[type="email"],textarea{
    border:  1px solid dashed;
    background-color: white;
    width: 480px;
    padding: .5em;
    font-size: 1.0em;
}
.Error{
    color: red;
    font-size: 1.2em;
font-family: Bitter,Georgia,Times,"Times New Roman",serif;}

.FieldInfo{
     color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.3em;


}
.MF{
    color: black;
    font-size: 1.2em;
font-family: Bitter,Georgia,Times,"Times New Roman",serif;}

</style>

<?php ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
<form  action="" method="post" >
<small style="color:red;">* Please Fill Out the following Fields</small>
<fieldset >

<input class="input" type="text" Name="Name" value="" placeholder="Name">
<span class="Error">*<?php echo $NameError;  ?></span><br>
<input class="input" type="text" Name="Email" value="" placeholder="E-mail" style="margin-top:0.5rem;">
<span class="Error">*<?php echo $EmailError; ?></span><br>
<span class="">
Gender:</span><br>
<input class="radio" type="radio" Name="Gender" value="Female"><span class="MF">Female</span>
<input class="radio" type="radio" Name="Gender" value="Male"><span class="MF">Male</span>
<span class="Error">*<?php echo $GenderError; ?></span><br>
<input class="input" type="text" Name="Website" value="" placeholder="Website">
<span class="Error">*<?php echo $WebsiteError; ?></span><br>

<textarea Name="Comment" rows="5" cols="25" placeholder="Message" style="margin-top:0.5rem;"></textarea>
<br>
<br>
<input class="btn btn-success btn-lg " type="Submit" Name="Submit" value="Submit Your Message">
   </fieldset>
</form>
</div>
</div>
</div>
<!-- end contact -->
<br>
<?php include "include/footer.php"; ?>


