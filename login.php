<?php include "include/req.php"; ?>

<?php
 global $ConnectingDB;
if(isset($_SESSION["UserId"])){
  Redirect_to("dashboard.php");
}
if (isset($_POST["Submit"])) {
  $Email =  mysqli_real_escape_string($ConnectingDB,$_POST["Email"]);
  $Password = mysqli_real_escape_string($ConnectingDB,$_POST["Password"]);
  if (empty($Email)||empty($Password)) {
    $_SESSION["ErrorMsg"]= "All fields must be filled out";
    Redirect_to("login.php");
    exit;
  }else {
    $Found_User=Login_Check($Email,$Password);
    if($Found_User){
        $_SESSION["UserId"]=mysqli_real_escape_string($ConnectingDB,$Found_User["id"]);
        $_SESSION["FirstName"]=mysqli_real_escape_string($ConnectingDB,$Found_User["fname"]);
        $_SESSION["LastName"]=mysqli_real_escape_string($ConnectingDB,$Found_User["lname"]);
        $_SESSION["Email"]=mysqli_real_escape_string($ConnectingDB,$Found_User["email"]);
        $_SESSION["SuccessMsg"] ="Welcome " .$_SESSION["LastName"];
        if(isset($_SESSION["TrackingURL"])){
          Redirect_to($_SESSION["TrackingURL"]);
        }
        Redirect_to("dashboard.php");
    }// var_dump($Found_User);
     else{
       $_SESSION["ErrorMsg"] ="Invalid password/username, try again";
       Redirect_to("login.php");
   }
  }
}
include "include/link.php";
?>

<link rel="stylesheet" href="css/stylereg.css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>

    <!--NAVBAR-->
    <div style="height: 1.2px; background: blue;"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">

  <a class="navbar-brand animated bounceInRight delay-2s" href="blog.php?page=1">
    <img  src="images/Original.jpg" width="60" height="30" class="rounded d-inline-block align-top" alt="">
    {LP} WITH RAHMAT</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  

</div>
</nav>
<div style="height: 1.2px; background: red;"></div>
<br>
<!--NAVBAR ending-->
<!--Header starting-->

<!-- Main Area-->

<section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6"style="min-height:67vh;">
        <br>
          <?php
           echo ErrorMsg();
           echo SuccessMsg();
           ?>
          <div class="card">
            <div class="card-header">
              <h4 class="lead text-center" style="color: royalblue;"><img  src="images/Original.jpg" width="60" height="30" class="rounded d-inline-block align-top" alt="">
              {LP} WITH RAHMAT</h4>
              </div>
              <div class="card-body">
              <form class="" action="login.php" method="post">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="email" class="form-control" name="Email" id="email" value="" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="Password" id="password" value=""placeholder="Password">
                  </div>
                </div>
                <input type="submit" name="Submit" class="btn btn-success btn-block" value="Sign in">
              </form>
 
            </div>
 
          </div>
 
        </div>
 
      </div>
 
    </section>


<!--End Main Area -->

<br>
<?php include "include/footer.php"; ?>