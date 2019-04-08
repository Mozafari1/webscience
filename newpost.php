<?php include "include/req.php";
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();
$AdminId = mysqli_real_escape_string($ConnectingDB,$_SESSION["UserId"]);
$sql2 = "SELECT lname FROM admins WHERE id='$AdminId'";
$stmt2 = mysqli_query($ConnectingDB, $sql2);
while ( $datarows=mysqli_fetch_assoc($stmt2) ) {
  $XLastName    = mysqli_real_escape_string($ConnectingDB,$datarows['lname']);
}
?>
<!-- sjekker hvis Submit Catagory button er presset da vil catagory navnet lagres i databasen
Sjekker også om feltet er tomt og hvis det er tomt skal den ikke lagres og gir en melding til brukeren
-->

<?php
if(isset($_POST["Submit"])){
  global $ConnectingDB;
  $PostTitle = mysqli_real_escape_string($ConnectingDB, $_POST["PostTitle"]);
  $Catagory=mysqli_real_escape_string($ConnectingDB,$_POST["Catagory"]);
  $Image = mysqli_real_escape_string($ConnectingDB,$_FILES["Image"]["name"]);
  $Target = mysqli_real_escape_string($ConnectingDB,"upload/".basename($_FILES["Image"]["name"]));
  $PostText = mysqli_real_escape_string($ConnectingDB,$_POST["PostDesc"]);
  $Admin =mysqli_real_escape_string($ConnectingDB,$_SESSION["LastName"]);
  date_default_timezone_set("Europe/Oslo");
  $CurrentTime=time();
  $Date=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
 
  if(empty($PostTitle)){
    $_SESSION["ErrorMsg"]= "Title can't be empty";
    Redirect_to("newpost.php");
  }elseif (strlen($PostTitle)<2) {
    $_SESSION["ErrorMsg"]= "Title should be greater than 2 characters";
    Redirect_to("newpost.php");
  }elseif (strlen($PostText)>19999) {
    $_SESSION["ErrorMsg"]= "Post Descriptions should be less than than 20000 characters";
    Redirect_to("newpost.php");
  }else{
    // Query to insert category in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO posts(date,title,catagory, author,image, post) 
    VALUES('$Date', '$PostTitle','$Catagory', '$Admin', '$Image', '$PostText')";
    
    $Execute=mysqli_query($ConnectingDB, $sql);

    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
 
    if($Execute){
      $_SESSION["SuccessMsg"]="New post added Successfully";
      Redirect_to("newpost.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again !";
      Redirect_to("newpost.php");
    }
  }
} //Ending of Submit Button If-Condition
 ?>
<?php include "include/link.php"; ?>
<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>New Post</title>
  </head>
  <body>

    <!--NAVBAR-->
 <?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle text-primary animated infinite rotateIn delay-6s"></i>&nbsp; <?php echo htmlentities($XLastName); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s " href="Catagories.php">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s active" href="newpost.php">New Post</a>
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
<div class="offset-lg-1 col-lg-10">
<?php 
echo ErrorMsg();
echo SuccessMsg();
?>

<form action="newpost.php" method="post" enctype="multipart/form-data">  

    <div class="card mb-3">
   
    <div class="card-body flipOutX delay-2s">
    <div class="form-group animated bounceInLeft delay-10s">
    <input class="form-control" type="text" name ="PostTitle" placeholder="Post title here ... " id="title" >
    </div>
    <div class="form-group animated bounceInRight delay-10s">
    <label for="CatagoryTitle" style="color:snow">Choose Catagory </label>
    <select class="form-control" id="CatagoryTitle" name="Catagory">
    <!-- Fetching all categories from category table -->
   <?php 
   global $ConnectingDB;
    $sql= "SELECT * FROM category";
    //$stmt = $ConnectingDB->query($sql);
    $Execute = mysqli_query($ConnectingDB, $sql);
    while($DateRows= mysqli_fetch_array($Execute)){
        $Id = $DateRows["id"];
        $Name = $DateRows["title"];

   ?>
   <option > <?php echo $Name; ?></option>
    <?php } ?>
    </select>
    </div>
    <div class="form-group  animated bounceInUp delay-10s">
        <div class="custom-file">
        <input class="custom-file-input" type="File" id ="imageSelect" name="Image">
        <label for="imageSelect" class="custom-file-label">Select Image</label>
        </div>
    </div>
    <div class="form-group animated bounceIn delay-10s">
    <textarea class="form-control" id="Post" name="PostDesc"  cols="80" rows="6" laceholder="Description here ..."></textarea>
    
    </div>
    <div class="row ">
   
    <button type="submit" name="Submit" class="btn btn-success btn-md btn-block mb-1 flipOutY delay-10s"><i class="far fa-smile-beam" style="color:blue;"></i> Submit New Post</button>
    </div>
    
    <div class="row">
       <button type="button" class="btn btn-outline-info btn-md btn-block  animated rotateIn delay-10s"> <i class="fas fa-undo"></i> <a href="dashboard.php">  Back To Dashboard</a>
</button>
   

    </div>
    </div>
    </div>
    </form>

</div>
</div>

</section>


<!--side area-->
<?php include "include/footer.php"; ?>