<?php include "include/req.php";
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
Confirm_Login(); 
$AdminId = mysqli_real_escape_string($ConnectingDB,$_SESSION["UserId"]);
$sql2 = "SELECT lname FROM admins WHERE id='$AdminId'";
$stmt2 = mysqli_query($ConnectingDB, $sql2);
while ( $datarows=mysqli_fetch_assoc($stmt2) ) {
  $XLastName    = mysqli_real_escape_string($ConnectingDB,$datarows['lname']);
}
include "include/link.php";
 ?> 
 
<link rel="stylesheet" href="css/stylereg.css">
    <meta charset="utf-8">
    <title>Dashboard</title>
  </head>
  <body>

    <!--NAVBAR-->
<?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle text-primary"></i>&nbsp; <?php echo htmlentities($XLastName); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s active" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>

      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="insertabout.php">About</a>
      </li>
    
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
<?php include "include/headerba.php"; ?>
<!--NAVBAR ending-->
<!--Header starting-->
<header class="transparent">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="slideLeft"><i class="fas fa-cog"></i>&nbsp;Dashboard</h1>
        <?php 
      
  echo ErrorMsg();
  echo SuccessMSg();
  ?>
   
      </div>
<?php include "include/dash4header.php"; ?>
<!--Main area-->
<section class="container "id ="dash4rows">
<div class="row">
<div class="col-lg-2">
    <div class="card text-center mb-3">
        <div class="card-body">
            <h1 class="lead"> Posts</h1>
            <h4 class="display-5">
                <i class="fab fa-readme" style="color:blue;"></i>
                <?php 
                    htmlentities(TotalPosts());
                ?>
            </h4>
        </div>
    </div>

    <div class="card text-center mb-3">
        <div class="card-body">
            <h1 class="lead">Categories</h1>
            <h4 class="display-5">
                <i class="fas fa-folder" style="color:blue;"></i>
                <?php 
                   htmlentities(TotalCatagory());
                ?>            
            </h4>
        </div>
    </div>

    <div class="card text-center mb-3">
        <div class="card-body">
            <h1 class="lead">Admins</h1>
            <h4 class="display-5">
                <i class="fas fa-user-alt" style="color:blue;"></i>
                <?php 
                     htmlentities(TotalAdmins());
                ?>           
             </h4>
        </div>
    </div>
    <div class="card text-center  mb-3">
        <div class="card-body">
            <h1 class="lead tex-white">Comments</h1>
            <h4 class="display-5">
                <i class="fas fa-comments" style="color:blue;"></i>
                <?php 
                  htmlentities( TotalComments());
                ?>
            </h4>
        </div>
    </div>
</div>
<!--Right side area starts-->

<div class="col-lg-10">
<h2 class="text-center"><i class="fas fa-mail-bulk" style="color: blue;"></i> Top 6 Posts</h2>

<table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM posts ORDER BY id asc LIMIT 0,6";
            $stmt=mysqli_query($ConnectingDB,$sql);
            while ($DataRows=mysqli_fetch_assoc($stmt)) {
              $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
              $Date = mysqli_real_escape_string($ConnectingDB,$DataRows["date"]);
              $Author  = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
              $Title = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
             ?>
            <tbody style="color:white;">
              <tr>
                <td><?php echo htmlentities( $PostId); ?></td>
                <td><?php echo htmlentities( $Title); ?></td>
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
                <td><?php echo htmlentities( $Date); ?></td>

                <td> <a target="_blank" href="fullpost.php?id=<?php echo htmlentities($PostId); ?>">
                  <span class="btn btn-info"><i class="far fa-eye" style="color:black"></i> Preview</span>
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