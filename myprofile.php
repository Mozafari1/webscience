<?php include "include/req.php"; ?>

<?php 

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>

<!-- sjekker hvis Submit Catagory button er presset da vil catagory navnet lagres i databasen
Sjekker også om feltet er tomt og hvis det er tomt skal den ikke lagres og gir en melding til brukeren
-->
<?php
// Fetching the existing Admin Data Start
global $ConnectingDB;

$AdminId = mysqli_real_escape_string($ConnectingDB,$_SESSION["UserId"]);
$sql2 = "SELECT fname, lname FROM admins WHERE id='$AdminId'";
$stmt2 = mysqli_query($ConnectingDB, $sql2);
while ( $datarows=mysqli_fetch_assoc($stmt2) ) {
  $XFirstName     = mysqli_real_escape_string($ConnectingDB,$datarows['fname']);
  $XLastName    = mysqli_real_escape_string($ConnectingDB,$datarows['lname']);
}

$sql  = "SELECT * FROM profile WHERE admin_id = '$AdminId'";
$stmt = mysqli_query($ConnectingDB,$sql);


  while ($DataRows = mysqli_fetch_assoc($stmt)) {

  $XStatus = mysqli_real_escape_string($ConnectingDB,$DataRows['status']);
  $XNotice= mysqli_real_escape_string($ConnectingDB,$DataRows['notice']);
  $XSchool   = mysqli_real_escape_string($ConnectingDB,$DataRows['school']);
  $XBio      = mysqli_real_escape_string($ConnectingDB,$DataRows['bio']);
  $XImage    = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
  $XCountry    = mysqli_real_escape_string($ConnectingDB,$DataRows['country']);
  $XCity    = mysqli_real_escape_string($ConnectingDB,$DataRows['city']);
  $XJob    = mysqli_real_escape_string($ConnectingDB,$DataRows['job']);

}
// Fetching the existing Admin Data End
if(isset($_POST["Submit"])){
  $Job     = mysqli_real_escape_string($ConnectingDB,$_POST["Job"]);
  $School = mysqli_real_escape_string($ConnectingDB,$_POST["School"]);
  $Country   = mysqli_real_escape_string($ConnectingDB,$_POST['Country']);
  $City      = mysqli_real_escape_string($ConnectingDB,$_POST["City"]);
  $Status     = mysqli_real_escape_string($ConnectingDB,$_POST["Status"]);
  $Notice = mysqli_real_escape_string($ConnectingDB,$_POST["Notice"]);
  $Bio   = mysqli_real_escape_string($ConnectingDB,$_POST['Bio']);
  $Image     = mysqli_real_escape_string($ConnectingDB,$_FILES["Image"]["name"]);
  $Target    = mysqli_real_escape_string($ConnectingDB,"images/".basename($_FILES["Image"]["name"]));
if (strlen($Job)>100) {
    $_SESSION["ErrorMsg"] = "Headline Should be less than 99 characters";
    Redirect_to("myprofile.php");
  }elseif(strlen($School)>100){
    $_SESSION["ErrorMsg"] = "Status Should be less than 99 characters";
    Redirect_to("myprofile.php");
  }
  elseif (strlen($Bio)>999) {
    $_SESSION["ErrorMsg"] = "Bio should be less than than 1000 characters";
    Redirect_to("myprofile.php");
  }else{
    // Query to Update Admin Data in DB When everything is fine
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE profile

              SET job='$Job', school='$School',country='$Country', bio='$Bio', city='$City', notice='$Notice', image='$Image', status='$Status'
              WHERE admin_id='$AdminId'";
    }else {
      $sql = "UPDATE profile
             SET job='$Job', school='$School', country='$Country', bio='$Bio', city='$City', notice='$Notice', status='$Status'
              WHERE admin_id='$AdminId'";
    }
    $Execute= $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
      $_SESSION["SuccessMsg"]="Details Updated Successfully";
      Redirect_to("myprofile.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again :)!";
      Redirect_to("myprofile.php");
    }
  }
} //Ending of Submit Button If-Condition

include "include/link.php";
 ?>

<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>My Profile</title>
  </head>
  <body>

    <!--NAVBAR-->
<?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s active" href="myprofile.php"><i class="fas fa-user-alt "style="color: green;"></i> <?php echo $XLastName; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s " href="Catagories.php">Catagory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="newpost.php">New Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="insertabout.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="comment.php">Comment</a>
      </li>
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
<?php include "include/headerba.php"; ?>
<!--NAVBAR ending-->
<!--Header starting-->
<!--Main area-->
<section class="container py-2 mb-4">
<div class="row">
<!-- Left area -->
    <div class="col-md-4">
        <div class="card">
          
            <div class="card-body">
                <img src="images/<?php echo htmlentities($XImage); ?>" class="block img-fluid md-3" alt="">
                <div class="">
             
                <div class="card-header bg-light text-dark-gray">
                <h4><?php echo htmlentities( $XFirstName  ),' ',htmlentities($XLastName);  ?></h4>
                <small style="color: green;">  <?php echo  htmlentities($XJob);?></small>
                <br>
                <small><?php echo htmlentities( $XSchool); ?></small>
              <br>
                <small style="color: blue;">  <?php echo htmlentities($XCountry),', ';?></small>
                <small><?php echo htmlentities( $XCity); ?></small>
                <br>
                <small><?php echo htmlentities( $XStatus); ?></small>
                <small style="float:right"><?php echo htmlentities( $XNotice); ?></small>

            </div>
            <br>
            <p style="color: white"><?php echo htmlentities($XBio); ?></p>
                </div>
            </div>
        </div>
    </div>
<!-- Right areaa -->
<div class="col-md-8">
<?php 
echo ErrorMsg();
echo SuccessMsg();
?>

<form action="myprofile.php" method="post" enctype="multipart/form-data">  

    <div class="card">
        <div class="card-header ">
        <h3>Edit Profile</h3>
        </div>
        <!-- start card-body  -->
    <div class="card-body flipOutX delay-2s">
    <div class="form-group animated bounceInLeft delay-10s">
    <input class="form-control" type="text" name ="Job" placeholder="Job Status" id="job" >
    </div>

<!-- End of name  -->
<div class="form-group animated bounceInRight delay-10s">
    <input class="form-control" type="text" name="School" placeholder="School/University " id="school" >   
    </div>

<!-- End of Headline -->
<div class="row">
    <div class="col animated bounceInLeft delay-10s">
        <div class="form-group">
    <input class="form-control" type="text" name ="Country" placeholder="Your Country" id="country" >
    </div>
        </div>
        <div class="col">
        <div class="form-group">
    <input class="form-control" type="text" name ="City" placeholder="City" id="city" >
    </div>
        </div>
        </div>
        <div class="row">
    <div class="col animated bounceInLeft delay-4s">
        <div class="form-group">
    <input class="form-control" type="text" name ="Status" placeholder="Relationship" id="status" >
    </div>
        </div>
        <div class="col">
        <div class="form-group">
    <input class="form-control" type="text" name ="Notice" placeholder="This is optional, but Admin must fielout" id="notice" >
    </div>
        </div>
        </div>
<div class="form-group animated bounceIn delay-10s">
    <textarea class="form-control" id="Post"placeholder="Bio" name="Bio"  cols="80" rows="6"></textarea>
    </div>
    <!-- End of Post -->
    <div class="form-group  animated bounceInUp delay-10s">
        <div class="custom-file">
        <input class="custom-file-input" type="File" id ="imageSelect" name="Image">
        <label for="imageSelect" class="custom-file-label"><i class="fas fa-image" style="color:blue;"></i> Select Image</label>
        </div>
    </div>
   <!-- End of Select Image -->

    <div class="row ">
   
    <button type="submit" name="Submit" class="btn btn-success btn-md btn-block mb-1 flipOutY delay-10s"><i class="fas fa-user-edit"></i> Submit</button>
    </div>
    
    <div class="row">
       <button type="button" class="btn btn-outline-info btn-md btn-block  animated rotateIn delay-10s">  <a href="dashboard.php"><i class="fas fa-undo"></i>  Back To Dashboard</a>
</button>
   

    </div>
    </div>
    </form>

</div>
</div>

</section>


<!--side area-->
<?php include "include/footer.php"; ?>