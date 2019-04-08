<?php include "include/req.php";
include "include/link.php";
?>

<link rel="stylesheet" href="css/aboutpage.css">
    <meta charset="utf-8">
    <title>About</title>
  </head>
  <body>

    <!--NAVBAR-->

    <?php require_once("include/header.php");?>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s " href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s active" href="about.php?page=1">About </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="contact.php?page=1">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link zoomOut delay-2s" href="color.php">Game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="#">Video</a>
      </li>

<?php require_once("include/headerbottom.php");
?>


<!--Contact starting-->
<div class="skewbox">
<div class="content">
  
<!--Start showing about content-->
<?php
global $ConnectingDB;
$sql ="SELECT * FROM about ORDER BY id desc LIMIT 0,1";
$stmt = mysqli_query($ConnectingDB, $sql);


while($DataRows =mysqli_fetch_assoc($stmt)){
    $PostId = mysqli_real_escape_string($ConnectingDB,$DataRows["id"]);
    $Date= mysqli_real_escape_string($ConnectingDB,$DataRows["date"]);
    $PostTitle = mysqli_real_escape_string($ConnectingDB,$DataRows["title"]);
    $Admin = mysqli_real_escape_string($ConnectingDB,$DataRows["author"]);
    $Image = mysqli_real_escape_string($ConnectingDB,$DataRows["image"]);
    $PostDesc =mysqli_real_escape_string($ConnectingDB, $DataRows["post"]);

?>

<!--ending showing about content-->


<h2> <?php echo htmlentities($PostTitle); ?></h2>

<small><hr></small>
<?php echo nl2br($PostDesc); ?>

<small class= "text-muted">
           <?php  echo "Writed by: ",htmlentities($Admin); ?> On <?php echo htmlentities($Date); ?></small>

</div> 
<div class="imagebox">
<img src="upload/<?php echo $Image; ?> " style="height:400px; width:550px;"/>

</div>
<?php }?>

</div>

<!-- end contact -->
<?php include "include/footer.php"; ?>


