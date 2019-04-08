













<?php include "include/req.php"; ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Animate/Animate.css">

    <script
   src="https://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
 <script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<style media ="screen">
.heading{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: bold;
    color: #005E90;
}
.heading:hover{
    color:#0090DB;
}
</style>

    <meta charset="utf-8">
    <title>Blog</title>
  </head>
  <body>

    <!--NAVBAR-->
    <div style="height: 1.2px; background: blue;"></div>
    <div style="height: 1px; background: red;"></div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">

  <a class="navbar-brand animated bounceInRight delay-2s" href="#">
    <img  src="images/Original.jpg" width="60" height="30" class="rounded d-inline-block align-top" alt="">
    {LP} WITH RAHMAT</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ">
     
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s active" href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="about.php?page=1">About </a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="contact.php?page=1">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link zoomOut delay-2s" href="color.php">Game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="video.php">Video</a>
      </li>

  </ul>
  <ul class="navbar-nav ml-auto">
  <form class="form-inline d-none d-sm-block" action ="blog.php">
    <input class="form-control mr-sm-2" type="text"name ="Search" placeholder="Search here" value="">
    <button class="btn btn-outline-success my-2 my-sm-0" name ="SearchButton">Search</button>
   
  </form>
  </ul>

</div>
</nav>
<div style="height: 1.3px; background: red;"></div>
<div style="height: 1.3px; background: blue"></div>
<div style="height: 1.3px; background: green;"></div>

<p class="text-right animated infinite fadeOutLeft zoomInRight rotateInY" style="color:darkblue; font-size:0.5rem">Welcome to {LP} WITH RAHMAT</p>

<!--NAVBAR ending-->
<!--Header starting-->
<div class="container">
<div class="row mt-2">
<!--Main area-->
<div class="col-sm-8 ">

<?php 
echo ErrorMsg();
echo SuccessMsg();
?>
<!-- Activiting the SearchButton -->
<?php 
global $ConnectingDB;
if(isset($_GET["SearchButton"])){
    $Search = $_GET["Search"];
    $sql = "SELECT * FROM posts
    WHERE datetime LIKE '%$Search%'
    OR title LIKE '%$Search%'
    OR catagory LIKE '%$Search%'
    OR post LIKE '%$Search%'";
    
   
  }
  // Query when category is active inURL tab
  elseif(isset($_GET["category"])){
    $Catagory=mysqli_real_escape_string($ConnectingDB,$_GET['category']);
    $sql= "SELECT * FROM posts WHERE catagory='$Catagory' ORDER BY id desc";
    //$stmt=mysqli_query($ConnectingDB,$sql);
  }
  elseif(isset($_GET["page"])){
    $Page= $_GET["page"];
    if($Page==0||$Page<1){
      $showPostFrom=0;
    }else{
    $showPostFrom=($Page*3)-3;}

    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $showPostFrom,3";
    //$stmt=mysqli_query($ConnectingDB,$sql);
      }else{
//  The defult Query

$sql ="SELECT * FROM posts ORDER BY id desc LIMIT 0,3";}
$stmt = mysqli_query($ConnectingDB, $sql);


while($DataRows =mysqli_fetch_assoc($stmt)){
    $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
    $DateTime = mysqli_real_escape_string($ConnectingDB,$DataRows["datetime"]);
    $PostTitle = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
    $Catagory = mysqli_real_escape_string($ConnectingDB,$DataRows["catagory"]);
    $Admin = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
    $Image = mysqli_real_escape_string($ConnectingDB,$DataRows["image"]);
    $PostDesc =mysqli_real_escape_string($ConnectingDB, $DataRows["post"]);

?>

    <div class ="card">
    <img class ="img-fluid card-img-top"  src="upload/<?php echo htmlentities ($Image); ?>"/>
        <div class= "card-body">
        <h4 class="card-title"> <?php echo htmlentities($PostTitle); ?></h4>
        <small class= "text-muted"> Posted by: <a href="profile.php?username=<?php  echo htmlentities($Admin); ?>"> <?php  echo htmlentities($Admin); ?></a> In Categoy: <a href="blog.php?category=<?php echo htmlentities( $Catagory);?>"><?php echo htmlentities($Catagory); ?></a> On <?php echo htmlentities($DateTime); ?></small>
      
         <span style ="float:right;" class="badge badge-dark text-light">Comments: <?php echo htmlentities(ApproveCommentsAccordingtoPost($PostId)); ?></span>
        <hr >
        <p class="card-text"> 
            <?php if(strlen($PostDesc)>130){
                $PostDesc = substr($PostDesc,0,130).'...';
            }
                echo nl2br($PostDesc); ?></p>
            <a href="fullpost.php?id=<?php echo htmlentities($PostId);?>"  style ="float:right;">
                <span class="btn btn-info">Read More</span>
            </a>
        </div>
    </div>
    <br> <!-- For å få litt luft mellom hver post-->
    <?php }?>
<!-- pagination -->
<nav>
            <ul class="pagination pagination-md">

            <?php 
                   if(isset($Page)){ 
                     if($Page>1){
                     ?>

                    <li class="page-item ">
                    <a href="blog.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
                  </li>
                 <?php } }?>
                <?php 
                
                  global $ConnectingDB;
                  $sql = "SELECT COUNT(*) FROM posts";
                  $stmt=mysqli_query($ConnectingDB, $sql);
                  $RowPage = mysqli_fetch_array($stmt);
                  $Totalpost=array_shift($RowPage);
                  // echo $Totalpost."<br>";
                  $PostPagination=$Totalpost/3;
                  $PostPagination =ceil($PostPagination);
                  // echo $PostPagination;
                   for($i =1; $i <=$PostPagination; $i++){
                      if(isset($Page)){
                          if($i==$Page){
                    ?>

                    <li class="page-item active">
                    <a href="blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                  </li>
                    <?php 
                  } else{
                     ?>
                <li class="page-item ">
                  <a href="blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                </li>
                  <?php }
                   }} ?>
                   <?php 
                   if(isset($Page)&&!empty($Page)){ 
                     if($Page+1<=$PostPagination){
                     ?>

                    <li class="page-item ">
                    <a href="blog.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
                  </li>
                 <?php } }?>
            </ul>
</nav>
</div>
<!--Side area-->

        <div class=" col-sm-4">
        <div class="card-mt-4">
                    <div class="card-body">
                    <img src="images/Original.png" class="d-block img-fluid mb-3" alt="">
                    <div class="text-center">
                    <h3 class="lead text-center"> WELCOME  TO {LP} WITH RAHMAT</h3>
                        <p class="lead"> This is a Coding Blog where I'm going to share my codes and give challenges</p>
                        <p style="color:red">challenge is comming soon  &nbsp;<i class="far fa-smile animated infinite heartBeat delay-3s" style="color: green"></i></p>
                  </div>
                    </div>
        </div>
     <div class="card">
          <div class="card-header bg-dark text-light">
                      <h2 class="lead">Sign In</h2>
          </div>     
            <div class="card-body">
                        <a href="allreg.php"><button type="button" class="btn btn-success btn-block text-center text-white mb-4"name="button">Join Us</button></a>

                        <a href="signup.php"><button type="button" class="btn btn-danger btn-block text-center text-white mb-4"name="button">Logg inn</button> </a>
                          <div class="input-group mb-3">
                        <input type="text" class="form-control" name="" placeholder="Enter your email" value="">
                        <div class="input-group-append">
                          <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                        </div>
                      </div>
            </div>
     </div>
        <br>
        <div class="card">
              <div class="card-header bg-primary text-light">
                      <h2 class="lead"> Categories</h2>
                      </div>

                      <div class="card-body">
                        <?php 
                          global $ConnectingDB;
                          $sql="SELECT * FROM category ORDER BY id desc";
                          $stmt =mysqli_query($ConnectingDB, $sql);
                          while($DataRows =mysqli_fetch_assoc($stmt)){
                            $CatagoryId = mysqli_real_escape_string($ConnectingDB,$DataRows['id']);
                            $CatagoryName = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
 
                        ?>

                       <a href="blog.php?category=<?php echo  $CatagoryName; ?>"> <span class="heading"> <?php echo $CatagoryName;?></span></a><br>
                          <?php }?>
              </div>
        </div>
<div class="card">
      <div class="card-header bg-info text-white">
                            <h2 class="lead"> Recent Posts</h2>
      </div>
<div class="card-body">
<?php
              global $ConnectingDB;
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= mysqli_query($ConnectingDB, $sql);
              while ($DataRows=mysqli_fetch_assoc($stmt)) {
                $Id     = mysqli_real_escape_string($ConnectingDB,$DataRows['id']);
                $Title  = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
                $DateTime = mysqli_real_escape_string($ConnectingDB,$DataRows['datetime']);
                $Image = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
              ?>
              <div class="media">
                <img src="upload/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="fullpost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                  <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
              </div>
              <hr>
              <?php } ?>

</div>
</div>

        <!-- side area ending -->
        </div>
</div>
</div>

<?php include "include/footer.php"; ?>