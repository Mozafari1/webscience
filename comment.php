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
?>
<?php include "include/link.php"; ?>
<link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Comment</title>
  </head>
  <body>

    <!--NAVBAR-->
<?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle text-primary"></i>&nbsp; <?php echo htmlentities($XLastName); ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="Catagories.php">Catagory</a>
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
        <a class="nav-link bounceIn delay-2s active" href="comment.php">Comment</a>
      </li>
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
  <?php include "include/headerba.php"; ?>
<!--NAVBAR ending-->
<!--Header starting-->
<!-- Comments starts -->
<section class="container py-2 mb-4"> 
    <div class="row">
        <div class="col-lg-12">
        <?php 
        echo ErrorMsg();
        echo SuccessMsg();
        ?>
        <h2 style="color: red"><i class="far fa-frown" style="color: blue;"></i> Unapproved</h2>

        <table class="table table-striped table-hover" style="color:white">
            <head class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </head>
            <?php 
                global $ConnectingDB;
                $sql= "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                $Execute =mysqli_query($ConnectingDB, $sql);
                while($DdatRows=mysqli_fetch_assoc($Execute)){
                    $C_Id = $DdatRows['id'];
                    $DateOfComment=mysqli_real_escape_string($ConnectingDB,$DdatRows['date']);
                    $C_Name =mysqli_real_escape_string($ConnectingDB,$DdatRows['name']);
                    $Content =mysqli_real_escape_string($ConnectingDB,$DdatRows['comment']);
                    $Post_Id = mysqli_real_escape_string($ConnectingDB,$DdatRows['post_id']);
                    
                  if(strlen($C_Name)>7){
                    $C_Name=substr($C_Name,0,6).'...';
                  }
                  if(strlen($DateOfComment)>8){
                    $DateOfComment=substr($DateOfComment,0,8).'...';
                  }
                  
            ?>
            <tbody>
                <tr>
                  <td><?php echo $C_Id; ?></td>
                  <td><?php echo htmlentities($C_Name); ?></td>
                  <td><?php echo htmlentities($Content) ?></td>
                  <td style="width:120px;"><?php echo htmlentities($DateOfComment); ?></td>        

                  <td style="width:200px;"><a href="approveComment.php?id=<?php echo htmlentities($C_Id); ?>"> 
            <span class="btn btn-outline-success btn-sm"><i class="fas fa-edit"style="color: black;"></i> Approve</span></a> 
           <a href="deleteComment.php?id=<?php echo htmlentities( $C_Id); ?>"> 
            <span class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"style="color: black;"></i> Delete</span></a>
            </td>
            <td style="width:120px;"><a href="fullpost.php?id=<?php echo htmlentities( $Post_Id); ?>" target="_blank"> 
            <span class="btn btn-outline-info btn-sm"><i class="far fa-eye"style="color: black;"></i> Preview</span></a></td>

                </tr>
            </tbody>
                <?php } ?>
            </table>

            <h2 style="color: green"><i class="far fa-smile" style="color:blue;"></i> Approved</h2>

<table class="table table-striped table-hover" style="color:snow">
    <head class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Action</th>
            <th>Details</th>
        </tr>
    </head>
    <?php 
        global $ConnectingDB;
        $sql= "SELECT * FROM comments WHERE status='ON' ORDER BY id asc";
        $Execute =mysqli_query($ConnectingDB,$sql);
        while($DdatRows=mysqli_fetch_assoc($Execute)){
            $C_Id = mysqli_real_escape_string($ConnectingDB,$DdatRows['id']);
            $DateOfComment =mysqli_real_escape_string($ConnectingDB,$DdatRows['date']);
            $C_Name =mysqli_real_escape_string($ConnectingDB,$DdatRows['name']);
            $Content =mysqli_real_escape_string($ConnectingDB,$DdatRows['comment']);
            $Post_Id = mysqli_real_escape_string($ConnectingDB,$DdatRows['post_id']);
            
          if(strlen($C_Name)>7){
            $C_Name=substr($C_Name,0,6).'...';
          }
          if(strlen($DateOfComment)>8){
            $DateOfComment=substr($DateOfComment,0,8).'...';
          }
          
    ?>
    <tbody>
        <tr>
          <td><?php echo $C_Id; ?></td>
          <td><?php echo htmlentities($C_Name); ?></td>
          <td><?php echo htmlentities($Content) ?></td>
          <td style="width:120px;"><?php echo htmlentities($DateOfComment); ?></td>        
          <td style="width:200px;"><a href="dis-approveComment.php?id=<?php echo htmlentities($C_Id); ?>"> 
            <span class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"style="color: black;"></i> Dis-Ap</span></a> 
           <a href="deleteComment.php?id=<?php echo htmlentities( $C_Id); ?>"> 
            <span class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"style="color: black;"></i> Delete</span></a>
            </td>
            <td style="width:120px;"><a href="fullpost.php?id=<?php echo htmlentities( $Post_Id); ?>" target="_blank"> 
            <span class="btn btn-outline-info btn-sm"><i class="far fa-eye"style="color: black;"></i> Preview</span></a></td>

        </tr>
    </tbody>
        <?php } ?>
    </table>

        </div>
    </div>
</section>
<!-- Comments Ends -->

<br>
<?php include "include/footer.php"; ?>
