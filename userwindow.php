<?php include "include/req.php"; ?>

<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Con_Log();
?>
<!-- sjekker hvis Submit Catagory button er presset da vil catagory navnet lagres i databasen
Sjekker også om feltet er tomt og hvis det er tomt skal den ikke lagres og gir en melding til brukeren
-->

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
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/window.css">



    <meta charset="utf-8">
    <title>Window</title>
  </head>
  <body>

    <!--NAVBAR-->
    <div style="height: 1.2px; background: blue;"></div>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">

  <a class="navbar-brand animated bounceInRight delay-2s" href="#">
    <img  src="images/Original.jpg" width="60" height="30" class="rounded d-inline-block align-top" alt="">
    {LP} WITH RAHMAT</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle text-primary"></i>&nbsp; Add Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s active" href="userwindow.php">Window</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s " href="Catagories.php">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="comment.php">Comment</a>
      </li>
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
       <a class ="nav-link heartBeat delay-1s" href="logout.php"><i class="fas fa-sign-out-alt text-danger"></i>&nbsp;Logout</a>
       </li>
  </ul>

</div>
</nav>
<div style="height: 1.2px; background: red;"></div>
<!--NAVBAR ending-->
<!--Header starting-->

<header class="transparent">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="slideLeft"><i class="fas fa-cog"></i>&nbsp;Dashboard</h1>
      </div>
      <div class ="col-lg-3 mb-1">
      <a href="newpost.php" class ="btn btn-primary btn-block">
      <i class="fas fa-edit"></i> Submit New Post
      </a>
      </div>
      <div class ="col-lg-3 mb-1">
      <a href="Catagories.php" class ="btn btn-info btn-block">
      <i class="fas fa-folder-plus"></i> Submit New Catagory
      </a>
      </div>
     
      <div class ="col-lg-3 mb-1">
      <a href="comment.php" class ="btn btn-success btn-block">
      <i class="fas fa-check"></i> Submit Comments
      </a>
      </div>
    </div>
  </div>
</header>

<!--Main area-->
<section class="container py-2 mb-4">
<div class="row">
<?php 
  echo ErrorMsg();
  echo SuccessMSg();
  ?>
   
 
<div class="col-lg-3">

      <!-- Testing cards
   -->
   <div class="card text-center bg-dark text-white  mb-3">
   <h1 class="lead card-header">Posts</h1>
   <div class="split">
       
   <h3 style="float:left; color: darkgray;">&nbsp;Users</h3>
                <h3 style="float:right;color: grey">Name &nbsp;</h3>
   </div>
        <div class="card-body">
           
            <h4 class="display-5" style="float:right;">
                <i class="fab fa-readme"></i>
                <?php 
                    htmlentities(TotalPosts());
                ?>
            </h4>
            <h4 class="display-5" style="float:left;">
                <?php 
                    htmlentities(TotalPosts());
                ?>
             <i class="fab fa-readme"></i>

            </h4>
        </div>
       
    </div>

 <!-- Testing cards ends
   -->
    <div class="card text-center bg-dark text-white  mb-3">
        <div class="card-body">
            <h1 class="lead">Posts</h1>
            <h4 class="display-5">
                <i class="fab fa-readme"></i>
                <?php 
                    htmlentities(TotalPosts());
                ?>
            </h4>
        </div>
    </div>

    <div class="card text-center bg-dark text-white  mb-3">
        <div class="card-body">
            <h1 class="lead">Categories</h1>
            <h4 class="display-5">
                <i class="fas fa-folder"></i>
                <?php 
                   htmlentities(TotalCatagory());
                ?>            
            </h4>
        </div>
    </div>

    <div class="card text-center bg-dark text-white  mb-3">
        <div class="card-body">
            <h1 class="lead">Users</h1>
            <h4 class="display-5">
                <i class="fas fa-user-alt"></i>
                <?php 
                     htmlentities(TotalAdmins());
                ?>           
             </h4>
        </div>
    </div>
    <div class="card text-center bg-dark text-white  mb-3">
        <div class="card-body">
            <h1 class="lead">Comments</h1>
            <h4 class="display-5">
                <i class="fas fa-comments"></i>
                <?php 
                  htmlentities( TotalComments());
                ?>
            </h4>
        </div>
    </div>
</div>
<!--Right side area starts-->

<div class="col-lg-9">
<h1>Top Posts</h1>

<table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>SR</th>
                <th>Title</th>
                <th>Date&Time</th>
                <th>Author</th>
                <th>Comments</th>
                <th>Details</th>
              </tr>
            </thead>
            <?php
            $SR = 0;
            global $ConnectingDB;
            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,6";
            $stmt=mysqli_query($ConnectingDB,$sql);
            while ($DataRows=mysqli_fetch_assoc($stmt)) {
              $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
              $DateTime = mysqli_real_escape_string($ConnectingDB,$DataRows["datetime"]);
              $Author  = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
              $Title = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
              $SR++;
             ?>
            <tbody>
              <tr>
                <td><?php echo htmlentities( $SR); ?></td>
                <td><?php echo htmlentities( $Title); ?></td>
                <td><?php echo htmlentities( $DateTime); ?></td>
                <td><?php echo htmlentities( $Author); ?></td>
                <td>
                    <?php $Total = ApproveCommentsAccordingtoPost(htmlentities($PostId));
                    if ($Total>0) {
                      ?>
                      <span class="badge badge-success">
                        <?php
                      echo htmlentities($Total); ?>
                      </span>
                        <?php  }   ?>
                  <?php $Total = DisApproveCommentsAccordingtoPost(htmlentities($PostId));
                  if ($Total>0) {  ?>
                    <span class="badge badge-danger">
                      <?php
                      echo htmlentities($Total); ?>
                    </span>
                         <?php  }  ?>
                </td>
                <td> <a target="_blank" href="fullpost.php?id=<?php echo htmlentities($PostId); ?>">
                  <span class="btn btn-info">Preview</span>
                </a>
              </td>
              </tr>
            </tbody>
            <?php } ?>
 
          </table>
		  
		  
		


</div>

<!--Right side area ends-->

</div>

</section>
<?php include "include/footer.php"; ?>