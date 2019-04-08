<?php include "include/req.php";
include "include/link.php"; 
?>
<link rel="stylesheet" href="css/blog2.css">

    <meta charset="utf-8">
    <title>Blog</title>
  </head>
  <body>
 
<?php require_once("include/header.php");?>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s active" href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="about.php?page=1">About </a>
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
  elseif(isset($_GET["catagory"])){
    $Catagory=mysqli_real_escape_string($ConnectingDB,$_GET['catagory']);
    $sql= "SELECT * FROM posts WHERE catagory='$Catagory' ORDER BY id desc";
  }

  elseif(isset($_GET["page"])){
    $Page= $_GET["page"];
    if($Page==0||$Page<1){
      $showPostFrom=0;
    }else{
    $showPostFrom=($Page*3)-3;}

    $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $showPostFrom,3";
      }else{
//  The defult Query

$sql ="SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
}
$stmt = mysqli_query($ConnectingDB, $sql);


while($DataRows =mysqli_fetch_assoc($stmt)){
    $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
    $Date = mysqli_real_escape_string($ConnectingDB,$DataRows["date"]);
    $PostTitle = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
    $Catagory = mysqli_real_escape_string($ConnectingDB,$DataRows["catagory"]);
    $Admin = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
    $Image = mysqli_real_escape_string($ConnectingDB,$DataRows["image"]);
    $PostDesc =mysqli_real_escape_string($ConnectingDB, $DataRows["post"]);

?>

    <div  class ="card">
    <img class ="img-fluid card-img-top"  src="upload/<?php echo htmlentities ($Image); ?>"/>
        <div class= "card-body">
        <h4 class="card-title"> <?php echo htmlentities($PostTitle); ?></h4>

        <small> Posted by: <a class="circle" href="profile.php?name=<?php  echo htmlentities($Admin); ?> "> <?php  echo htmlentities($Admin); ?></a>
<!-- fix circle profile -->

        In Categoy: <a href="blog.php?catagory=<?php echo htmlentities( $Catagory);?>"><?php echo htmlentities($Catagory); ?></a> On <?php echo htmlentities($Date); ?></small>
      
         <span style ="float:right;" class="badge badge-light text-dark">Comments: <?php echo htmlentities(ApproveCommentsAccordingtoPost($PostId)); ?></span>
        <hr >
        <p class="card-text"> 
            <?php if(strlen($PostDesc)>130){
                $PostDesc = substr($PostDesc,0,130).'...';
            }
                echo nl2br($PostDesc); ?></p>
           
           <a href="fullpost.php?id=<?php echo htmlentities($PostId);?>"  style ="float:right;">
                <span id ="but" class="btn btn-info">Read More</span>
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
<?php include("include/sidearea.php"); ?>
        <!-- side area ending -->
        </div>
</div>
</div>

<?php include ("include/footer.php"); ?>
