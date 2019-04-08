<?php include "include/req.php"; ?>

<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
//echo $_SESSION["TrackingURL"];
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
<!-- including link-->

  <?php include "include/link.php"; ?>  
  <link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Posts</title>
  </head>
  <body>

<?php include "include/header.php"; ?>

      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s active" href="myprofile.php"><i class="fas fa-user-alt "style="color: green;"></i> <?php echo $XLastName; ?></a>
      </li>

      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s active" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
 <?php include "include/headerba.php"; ?>
<!--NAVBAR ending-->
<!--Header starting-->

<header >
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2><i class="fas fa-blog"style="color:blue;"></i>&nbsp;Blog Posts</h2>
      </div>
<?php include "include/dash4header.php"; ?>
<!--Main area-->
<section class="container py-2 mb-4">
<div class="row">
<div class="col-lg-12">
  <?php 
  echo ErrorMsg();
  echo SuccessMSg();
  ?>
    <table class="table table--striped  table-hover" style="color:snow">
    <thead  class="thead-dark">

        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Image</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Action</th>
            <th>Live Preview</th>
        </tr>
        </thead>

        <?php
            global $ConnectingDB;
            $sql= "SELECT * FROM posts";
            $stmt = mysqli_query($ConnectingDB,$sql);
            while($DataRows = mysqli_fetch_assoc($stmt)){
                $Id =     mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
                $PostTitle =  mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
                $Catagory =  mysqli_real_escape_string($ConnectingDB,$DataRows["catagory"]);
                $Date =  mysqli_real_escape_string($ConnectingDB,$DataRows["date"]);
                $Admin =  mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
                $Image =  mysqli_real_escape_string($ConnectingDB,$DataRows["image"]);
                $PostText =  mysqli_real_escape_string($ConnectingDB,$DataRows["post"]);
            
        
        ?>    
          <tbody>
    
        <tr>
            <td><?php echo $Id; ?></td>
            <td><?php if(strlen($PostTitle)>18){
                $PostTitle=substr($PostTitle,0,11).'..';
            }
            echo htmlentities($PostTitle);?></td>
            
            <td><?php if(strlen($Admin)>6){
                $Admin=substr($Admin,0,6).'..';
            }
            echo htmlentities( $Admin); ?></td>

            <td><?php if(strlen($Catagory)>8){
                $Catagory=substr($Catagory,0,8).'..';
            } echo htmlentities($Catagory);?></td>

          
     
            <td><img src="upload/<?php echo htmlentities($Image);?>" width="150px;" height="50px;"></td>
            <td>
                    <?php $Total = ApproveCommentsAccordingtoPost($Id);
                    if ($Total>0) {
                      ?>
                      <span class="badge badge-success">
                        <?php
                      echo htmlentities($Total); ?>
                      </span>
                      
                        <?php  }   ?>
                  <?php $Total = DisApproveCommentsAccordingtoPost($Id);
                  if ($Total>0) {  ?>
                    <span class="badge badge-danger">
                      <?php
                      echo htmlentities($Total); ?>
                    </span>
                         <?php  }  ?>
                </td>
                <td><?php if(strlen($Date)>11){
                $Date=substr($Date,0,11).'..';
            }
            echo htmlentities( $Date); ?></td>
            <td style="width:200px;"><a href="edit.php?id=<?php echo htmlentities( $Id); ?>"> 
            <span class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"style="color: white;"></i> Edit</span></a>
            <a href="delete.php?id=<?php echo htmlentities( $Id); ?>"> 
            <span class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"style="color: white;"></i> Delete</span></a>
            </td>

            <td style="width:120px;"><a href="fullpost.php?id=<?php echo htmlentities( $Id); ?>" target="_blank"> 
            <span class="btn btn-outline-info btn-sm"><i class="far fa-eye" style=color:black></i>Preview</span></a></td>

        </tr>
        </tbody>

            <?php } ?>
    </table>
</div>
</div>

</section>

<!--side area-->
<?php include "include/footer.php"; ?>