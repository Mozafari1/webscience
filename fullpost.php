<?php include "include/req.php"; ?>

<?php
global $ConnectingDB;
 $SearchQueryParameter = mysqli_real_escape_string($ConnectingDB,$_GET["id"]);
if(isset($_POST["Submit"])){
  $Name    = mysqli_real_escape_string($ConnectingDB,$_POST["CommenterName"]);
  $Email   = mysqli_real_escape_string($ConnectingDB,$_POST["CommenterEmail"]);
  $Comment = mysqli_real_escape_string($ConnectingDB,$_POST["CommenterThoughts"]);
  date_default_timezone_set("Europe/Oslo");
  $CurrentTime=time();
  $Date=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
 
  if(empty($Name)||empty($Email)||empty($Comment)){
    $_SESSION["ErrorMsg"]= "All fields must be filled out";
    Redirect_to("fullpost.php?id={$SearchQueryParameter}");
  }elseif (strlen($Comment)>20000) {
    $_SESSION["ErrorMsg"]= "Comment length should be less than 1000 characters";
    Redirect_to("fullpost.php?id={$SearchQueryParameter}");
  }else{
    // Query to insert comment in DB When everything is fine
    $sql  = "INSERT INTO comments(date,name,email,comment,aby, status, post_id)
  VALUES('$Date','$Name','$Email','$Comment', 'Pending','OFF','$SearchQueryParameter')";
   // $stmt -> bind_param("vvvvv",$DateTime,$Name,$Email,$Comment,$SearchQueryParameter);
    

    $Execute = mysqli_query($ConnectingDB,$sql);
    //var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMsg"]="Comment Submitted Successfully";
      Redirect_to("fullpost.php?id={$SearchQueryParameter}");
    }else {
      $_SESSION["ErrorMsg"]="Something went wrong. Try Again !";
      Redirect_to("fullpost.php?id={$SearchQueryParameter}");
    }
  }
} //Ending of Submit Button If-Condition
include "include/link.php";
?>

<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Blog</title>
  </head>
  <body>

    <!--NAVBAR-->
      <?php include ("include/header.php");?>
 
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s active" href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s " href="about.php?page=1">About </a>
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

<?php require_once("include/headerbottom.php");
?>

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



<?php 
global $ConnectingDB;
if(isset($_GET["SearchButton"])){
    $Search = mysqli_real_escape_string($ConnectingDB, $_GET["Search"]);
    $sql = "SELECT * FROM posts
    WHERE datetime LIKE '%$Search%'
    OR title LIKE '%$Search%'
    OR category LIKE '%$Search%'
    OR post LIKE '%$Search%'";
  }

else{
  $PostIDFromURL=$_GET["id"];
		$ViewQuery="SELECT * FROM posts WHERE id='$PostIDFromURL'
    ORDER BY date desc";
    }
  $stmt = mysqli_query($ConnectingDB, $ViewQuery);

  /*
$PostIdFromURL = mysqli_real_escape_string($ConnectingDB,$_GET["id"]);
if(!isset($PostIdFromURL)){
    $_SESSION["ErrorMsg"] = "Bad request, try again";
    Redirect_to("blog.php");
}

$sql = "SELECT * FROM posts WHERE id ='$PostIdFromURL'";
$stmt = $ConnectingDB->query($sql);

/*
$Result=mysqli_fetch_assoc($stmt);
if($Result!==1){
  $_SESSION["ErrorMsg"] = "Bad request no, try again";
  Redirect_to("blog.php?page=1");
}
}*/
while($DataRows = mysqli_fetch_assoc($stmt)){
    $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
    $Date = mysqli_real_escape_string($ConnectingDB,$DataRows["date"]);
    $PostTitle = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
    $Catagory = mysqli_real_escape_string($ConnectingDB,$DataRows["catagory"]);
    $Admin = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
    $Image = mysqli_real_escape_string($ConnectingDB,$DataRows["image"]);
    $PostDesc = mysqli_real_escape_string($ConnectingDB,$DataRows["post"]);
 // check this brackets
?>

    <div class ="card">
    <img class ="img-fluid card-img-top"  src="upload/<?php echo htmlentities ($Image); ?>"/>
        <div class= "card-body">
        <h4 class="card-title text-white" > <?php echo htmlentities($PostTitle); ?></h4>
        <small class= "text-white"> Posted by: <a href="profile.php?username=<?php  echo htmlentities($Admin); ?>"> <?php  echo htmlentities($Admin); ?></a> </a> In Categoy: <a href="blog.php?catagory=<?php echo $Catagory;?>"><?php echo $Catagory; ?></a> On <?php echo htmlentities($Date); ?></small>
        <span style ="float:right;" class="badge badge-light text-dark">Comments: <?php echo htmlentities(ApproveCommentsAccordingtoPost($PostId)); ?> </span>
        <hr style="color:green;">
        <p class="card-text" style="color:floralwhite;"> 
            <?php
                echo htmlentities(nl2br($PostDesc)); ?></p>
          
        </div>
    </div>
    <br> <!-- For å få litt luft mellom hver post-->
    <?php }?>
    <!-- Fetching existing comment start-->

<div >
    <form class="" action="fullpost.php?id=<?php echo htmlentities($SearchQueryParameter); ?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 style="color:snow;"><i class="fas fa-comment-dots" style="color:yellow;"></i> Post  a Comment</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterEmail" placeholder="Email" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea name="CommenterThoughts" class="form-control" rows="4" cols="40"></textarea>
                  </div>
                  <div class="">
                    <button type="submit" name="Submit" class="btn btn-primary form-control">Submit Comment</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
<?php
  global $ConnectingDB;
  $sql = "SELECT * FROM comments WHERE post_id ='$SearchQueryParameter' AND status='ON' ORDER BY date desc";
  $stmt = $ConnectingDB->query($sql);
  while($DataRows=mysqli_fetch_assoc($stmt)){
    $CommentDate = mysqli_real_escape_string($ConnectingDB,$DataRows['date']);
    $CommentName = mysqli_real_escape_string($ConnectingDB,$DataRows['name']);
    $CommentPost  = mysqli_real_escape_string($ConnectingDB,$DataRows['comment']);
  
?>
<div >
      <div class="media comment-block">
        <img src="images/user.png" width="60" height = "60" class="d-block rounded img-fluid"alt="">
    
          <div class= "media-body ml-2">
              <h6 class="lead"><?php echo htmlentities($CommentName);?></h6>
              <p class="small"><?php echo htmlentities($CommentDate);?></p>
              <p><?php echo htmlentities($CommentPost);?></p>  
           </div>
      </div>
      <br>

</div>
<?php }?>
<br>
    <!-- Fetching existing comment END-->

    <!-- komment part start -->
    
</div>
<!--END OF Main area-->

<!--Side area-->
<?php include("include/sideareaf.php"); ?>

        <!-- side area ending -->
        </div>
<!-- end of side are -->

</div>
</div>

<?php include("include/footer.php"); ?>