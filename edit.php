<?php include "include/req.php";
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login(); 
global $ConnectingDB;

$SarchQueryParameter = mysqli_real_escape_string($ConnectingDB,$_GET['id']);
if(isset($_POST["Submit"])){
  $PostTitle = mysqli_real_escape_string($ConnectingDB, $_POST["PostTitle"]);
  $Category  = mysqli_real_escape_string($ConnectingDB, $_POST["Category"]);
  $Image     = mysqli_real_escape_string($ConnectingDB, $_FILES["Image"]["name"]);
  $Target    = "upload/".basename($_FILES["Image"]["name"]);
  $PostText  = mysqli_real_escape_string($ConnectingDB, $_POST["PostDescription"]);
  $Admin = mysqli_real_escape_string($ConnectingDB, $_SESSION["LastName"]);
  date_default_timezone_set("Europe/Oslo");
  $CurrentTime = time();
  $Date    = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
 
  if(empty($PostTitle)){
    $_SESSION["ErrorMsg"]= "Title Cant be empty";
    Redirect_to("posts.php");
  }elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMsg"]= "Post Title should be greater than 5 characters";
    Redirect_to("posts.php");
  }elseif (strlen($PostText)>19999) {
    $_SESSION["ErrorMsg"]= "Post Description should be less than than 1000 characters";
    Redirect_to("posts.php");
  }else{
    // Query to Update Post in DB When everything is fine
   
    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE posts
              SET title='$PostTitle', catagory='$Category', image='$Image', post='$PostText'
              WHERE id='$SarchQueryParameter'";
    }else {
      $sql = "UPDATE posts
              SET title='$PostTitle', catagory='$Category', post='$PostText'
              WHERE id='$SarchQueryParameter'";
    }
    $Execute= mysqli_query($ConnectingDB,$sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    //var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMsg"]="Post Updated Successfully";
      Redirect_to("posts.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again !";
      Redirect_to("posts.php");
    }
  }
} //Ending of Submit Button If-Condition
 include "include/link.php"; 
 ?>

 <link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Edit</title>
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
        <a class="nav-link bounceIn delay-2s active" href="Catagories.php">Catagory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="admin.php">Admin</a>
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
       // Fetching Existing Content according to our
       global $ConnectingDB;
       $sql  = "SELECT * FROM posts WHERE id='$SarchQueryParameter'";
       $stmt = mysqli_query($ConnectingDB ,$sql);
       while ($DataRows=mysqli_fetch_assoc($stmt)) {
         $TitleToBeUpdated    = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
         $CategoryToBeUpdated = mysqli_real_escape_string($ConnectingDB,$DataRows['catagory']);
         $ImageToBeUpdated    = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
         $PostToBeUpdated     = mysqli_real_escape_string($ConnectingDB,$DataRows['post']);
         // code...
       }
       ?>
      <form class="" action="edit.php?id=<?php echo htmlentities($SarchQueryParameter); ?>" method="post" enctype="multipart/form-data">
        <div class="card text-light mb-3">
          <div class="card-body">
            <h2 class="text-center">  <i class="far fa-edit"style="color:blue;"></i> Edit Post</h2>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> New Post Title <i class="fas fa-level-down-alt" style="color:blue;"></i></span></label>
               <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo htmlentities( $TitleToBeUpdated); ?>">
            </div>
            <div class="form-group">
              <span class="FieldInfo1">Existing Category <i class="fas fa-angle-double-right" style="color:blue;"></i></span>
              <?php echo htmlentities($CategoryToBeUpdated);?>
              <br>
              <label for="CategoryTitle"> <span class="FieldInfo"> Choose New Categroy <i class="fas fa-level-down-alt" style="color:blue;"></i></span></label>
               <select class="form-control" id="CategoryTitle"  name="Category">
                 <?php
                 //Fetchinng all the categories from category table
                 global $ConnectingDB;
                 $sql  = "SELECT id,title FROM category";
                 $stmt = mysqli_query($ConnectingDB,$sql);
                 while ($DataRows = mysqli_fetch_assoc($stmt)) {
                   $Id            = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
                   $CategoryName  = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
                  ?>
                  <option> <?php echo htmlentities( $CategoryName); ?></option>
                  <?php } ?>
               </select>
            </div>
                  

            <div class="form=group mb-1">
              <span class="FieldInfo1">Existing Image <i class="fas fa-angle-double-right" style="color:blue;"></i> </span>
              <img  class="mb-1" src="upload/<?php echo htmlentities($ImageToBeUpdated);?>" width="170px"; height="70px"; >
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select New Image </label>
              </div>
            </div>
           
            <div class="form-group">
    <label for="Post"><span class="FieldInfo">New Post Description <i class="fas fa-level-down-alt" style="color:blue;"></i></span> </label>
    <textarea class="form-control" id="Post" name="PostDescription"  cols="80" rows="6"> <?php echo htmlentities($PostToBeUpdated);?></textarea>
    
    </div>
           
            <div class="row">
   
    <button type="submit" name="Submit" class="btn btn-success btn-md btn-block mb-1"><i class="fas fa-plus-circle"></i> Edit Post</button>
    </div>
    
    <div class="row">
       <button type="button" class="btn btn-outline-info btn-md btn-block flipOutX delay-3s">  <a href="dashboard.php"><i class="fas fa-undo"></i>  Back To Dashboard</a>
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