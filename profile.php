<?php include "include/req.php"; ?>

<?php  
    global $ConnectingDB;
    $SearchQueryParameter = mysqli_real_escape_string($ConnectingDB,$_GET["name"]);
    $AdminId = mysqli_real_escape_string($ConnectingDB,$_SESSION["UserId"]);
    $sql2 = "SELECT fname, lname FROM admins WHERE lname='$SearchQueryParameter'";
    $stmt2 = mysqli_query($ConnectingDB, $sql2);
    while ( $datarows=mysqli_fetch_assoc($stmt2) ) {
      $XFirstName     = mysqli_real_escape_string($ConnectingDB,$datarows['fname']);
      $XLastName    = mysqli_real_escape_string($ConnectingDB,$datarows['lname']);
    }
    $sql =  "SELECT * FROM profile WHERE admin_id='$AdminId'";

    $stmt = mysqli_query($ConnectingDB,$sql);
   $Result=mysqli_num_rows($stmt);
if( $Result==1 ){
  while ( $DataRows   = mysqli_fetch_assoc($stmt) ) {
 
    $XStatus = mysqli_real_escape_string($ConnectingDB,$DataRows['status']);
    $XNotice= mysqli_real_escape_string($ConnectingDB,$DataRows['notice']);
    $XSchool   = mysqli_real_escape_string($ConnectingDB,$DataRows['school']);
    $XBio      = mysqli_real_escape_string($ConnectingDB,$DataRows['bio']);
    $XImage    = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
    $XCountry    = mysqli_real_escape_string($ConnectingDB,$DataRows['country']);
    $XCity    = mysqli_real_escape_string($ConnectingDB,$DataRows['city']);
    $XJob    = mysqli_real_escape_string($ConnectingDB,$DataRows['job']);
  
  }
}else {
  $_SESSION["ErrorMsg"]="Bad Request!";
  Redirect_to("blog.php?page=1");
}
 include "include/link.php";
 ?>
 
 <link rel="stylesheet" href="css/profile.css">

    <meta charset="utf-8">
    <title>Profile</title>
  </head>
  <body>

  <!--NAVBAR-->
  <?php include "include/header.php"; ?>
  <li class="nav-item">
    <a class="nav-link animated bounceInUp delay-2s active" href="blog.php?page=1">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link animated bounceInDown delay-1s" href="about.php?page=1">About </a>
  </li>

  <li class="nav-item">
    <a class="nav-link flipOutY delay-4s" href="contact.php">Contact</a>
  </li>
  <li class="nav-item">
        <a class="nav-link zoomOut delay-2s" href="color.php">Game</a>
      </li>
  <li class="nav-item">
    <a class="nav-link bounceIn delay-2s" href="#">Video</a>
  </li>
  <?php require_once("include/headerbottom.php");
?>
<br>
<!--NAVBAR ending-->
<div class="container" id="cont">
  <div class="avatar-flip">
    <img src="images/<?php echo htmlentities($XImage); ?>" height="150" width="150">
    <img src="images/Original.png" height="150" width="150">
  </div>
  <h3><?php echo htmlentities( $XFirstName  ),' ',htmlentities($XLastName);  ?></h3>
  <small>  <?php echo  htmlentities($XJob);?></small>
                <br>
                <small><?php echo htmlentities( $XSchool); ?></small>
              <br>
                <small>  <?php echo htmlentities($XCountry),',';?></small>
                <small><?php echo htmlentities( $XCity); ?></small>
                <br>
                <small><?php echo htmlentities( $XStatus); ?></small>
                <small style="float:right"><?php echo htmlentities( $XNotice); ?></small>
              <hr>
                <p ><?php echo htmlentities($XBio); ?></p>

  <a href="https://www.instagram.com/lp_with_rahmat/"><i class="fab fa-instagram"></i></a> 
  <a href="https://www.youtube.com/channel/UCow-m8KxH7G0MiePPQeREBw"><i class="fab fa-youtube"></i></a> 
  <a href="https://www.facebook.com/R2hm2t.Davidsen"><i class="fab fa-facebook-f"></i></a>
  <a href="https://github.com/Mozafari1"><i class="fab fa-github"></i></a> 
  <p><button class="btn btn-info" id="but"><a href="contact.php">Contact</a></button></p>
</div>

    <!-- footer start -->
    <?php include "include/footer.php"; ?>