<?php include "include/req.php"; ?>

<?php 
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login();
 ?>

<!-- sjekker hvis Submit Catagory button er presset da vil catagory navnet lagres i databasen
Sjekker også om feltet er tomt og hvis det er tomt skal den ikke lagres og gir en melding til brukeren
-->

<?php
global $ConnectingDB;
$SarchQueryParameter = mysqli_real_escape_string($ConnectingDB,$_GET['id']);
// Fetching Existing Content according to our post
$sql  = "SELECT * FROM posts WHERE id='$SarchQueryParameter'";
$stmt = mysqli_query($ConnectingDB, $sql);
while ($DataRows=mysqli_fetch_assoc($stmt)) {
  $TitleToBeDeleted    = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
  $CategoryToBeDeleted = mysqli_real_escape_string($ConnectingDB,$DataRows['catagory']);
  $ImageToBeDeleted    = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
  $PostToBeDeleted     = mysqli_real_escape_string($ConnectingDB,$DataRows['post']);
  // code...
}
// echo $ImageToBeDeleted;
if(isset($_POST["Submit"])){
    // Query to Delete Post in DB When everything is fine
    global $ConnectingDB;
    $sql = "DELETE FROM posts WHERE id='$SarchQueryParameter'";
    $Execute =mysqli_query($ConnectingDB, $sql);
    //var_dump($Execute);
    if($Execute){
      $Target_Path_To_DELETE_Image = "upload/$ImageToBeDeleted";
      unlink($Target_Path_To_DELETE_Image);
      $_SESSION["SuccessMsg"]="Post DELETED Successfully";
      Redirect_to("posts.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again !";
      Redirect_to("posts.php");
    }
} //Ending of Submit Button If-Condition
 ?>
<?php include "include/link.php"; ?>
<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Delete</title>
  </head>
  <body>

    <!--NAVBAR-->
  <?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle text-primary"></i>&nbsp;My Profile</a>
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
        <a class="nav-link bounceIn delay-2s" href="comment.php">Comment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s active" href="delete.php">Delete</a>
      </li>
      <li class="nav-item">
          <a class="nav-link bounceIn delay-2s" href="blog.php?page=1">Blog</a>
    </li>
<?php include "include/headerba.php"; ?>
<!--NAVBAR ending-->
<!--Header starting-->

<section class="container py-2 mb-4">
<div class="row">
<div class="offset-lg-1 col-lg-10">
<?php 
echo ErrorMsg();
echo SuccessMsg();

?>
<form action="delete.php?id=<?php echo htmlentities($SarchQueryParameter); ?>" method="post" enctype="multipart/form-data">  

    <div class="card  mb-3">
   
    <div class="card-body ">

    
    <div class="form-group">
              <label > <span >Title <i class="fas fa-level-down-alt" style ="color:blue;"></i></span></label>
               <input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo htmlentities( $TitleToBeDeleted); ?>">
            </div>
            <div class="form-group">
              <span>Existing Category <i class="fas fa-chevron-right" style="color:blue;"></i>  </span>
              <?php echo htmlentities($CategoryToBeDeleted);?>
              <br>
            </div>
            <div class="form-group">
              <span>Existing Image <i class="fas fa-chevron-right" style="color:blue;"></i></span>
              <img  class="mb-1" src="upload/<?php echo htmlentities($ImageToBeDeleted);?>" width="170px"; height="70px"; >
            </div>
           
    <div class="form-group">
    <label><span >Post Description <i class="fas fa-level-down-alt" style ="color:blue;"></i></span> </label>
    <textarea disabled class="form-control" id="Post" name="PostDesc"  cols="80" rows="8"> <?php echo htmlentities( $PostToBeDeleted); ?></textarea>
    
    </div>

            <div class="row">
   
   <button type="submit" name="Submit" class="btn btn-danger btn-md btn-block mb-1"><i class="far fa-trash-alt"style="color: blue;"></i>&nbsp;Delete Post</button>
   </div>
   
   <div class="row">
      <button type="button" class="btn btn-outline-info btn-md btn-block flipOutX delay-3s">  <a href="dashboard.php">  <i class="fas fa-undo-alt"></i>&nbsp;Back To Dashboard</a>
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