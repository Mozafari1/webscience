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
<!-- sjekker hvis Submit Catagory button er presset da vil catagory navnet lagres i databasen
Sjekker også om feltet er tomt og hvis det er tomt skal den ikke lagres og gir en melding til brukeren
-->

<?php
if(isset($_POST["Submit"])){
  global $ConnectingDB;
  $Catagory = mysqli_real_escape_string($ConnectingDB,$_POST["CatagoryTitle"]);
  $Admin =mysqli_real_escape_string($ConnectingDB,$_SESSION["LastName"]);
  date_default_timezone_set("Europe/Oslo");
  $CurrentTime=time();
  $Date=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
 
  if(empty($Catagory)){
    $_SESSION["ErrorMsg"]= "All fields must be filled out";
    Redirect_to("Catagories.php");
  }elseif (strlen($Catagory)<3) {
    $_SESSION["ErrorMsg"]= "Category title should be greater than 2 characters";
    Redirect_to("Catagories.php");
  }elseif (strlen($Catagory)>49) {
    $_SESSION["ErrorMsg"]= "Category title should be less than than 50 characters";
    Redirect_to("Catagories.php");
  }else{
    // Query to insert category in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO category(title,author,date) VALUES('$Catagory','$Admin','$Date')";
    $Execute = mysqli_query($ConnectingDB, $sql);

    if($Execute){
      $_SESSION["SuccessMsg"]="Category with id :  added Successfully";
      Redirect_to("Catagories.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again !";
      Redirect_to("Catagories.php");
    }
  }
} //Ending of Submit Button If-Condition
 ?>
<?php include "include/link.php"; ?>
<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Catagory</title>
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
        <a class="nav-link bounceIn delay-2s active" href="Catagories.php">Catagory</a>
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
<div class="offset-lg-1 col-lg-10" style="min-height:404px;">
<?php 
echo ErrorMsg();
echo SuccessMsg();
?>

<form action="Catagories.php" method="post"> 
    <div class="card mb-3">
    <h2 class="text-center"><i class="far fa-object-group" style= "color: blue;"></i> Add Category</h2>

    <div class="card-body">
    <div class="form-group">

    <input class="form-control" type="text" name ="CatagoryTitle" placeholder="Category Title" id="title" >
    </div>
    <div class="row">
   
    <button type="submit" name="Submit" class="btn btn-success btn-md btn-block mb-1"><i class="fas fa-user-plus"></i> &nbsp;Submit Catagory</button>
    </div>
    
    <div class="row">
       <button type="button" class="btn btn-outline-info btn-md btn-block flipOutX delay-3s">  <i class="fas fa-undo-alt"></i> <a href="dashboard.php">  Back To Dashboard</a>
</button>
   

    </div>
    </div>
    </div>
    </form>



    <h2 style="color:white"><i class="fas fa-ellipsis-v" style="color: blue;"></i> &nbsp;Category Lists</h2>

<table class="table table-striped table-hover" style="color:white">
    <head class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Added by</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </head>
    <?php 
        global $ConnectingDB;
        $sql= "SELECT * FROM category ORDER BY id desc";
        $Execute =mysqli_query($ConnectingDB,$sql);
        $SR =0;
        while($DdatRows=mysqli_fetch_assoc($Execute)){
            $Id = $DdatRows['id'];
            $Date =$DdatRows['date'];
            $Name =$DdatRows['title'];
            $Addedby =$DdatRows['author'];
            $SR++;
       
    ?>
    <tbody>
        <tr>
          <td><?php echo $Id; ?></td>
          <td><?php echo $Name; ?></td>
          <td><?php echo $Addedby ?></td>
          <td><?php echo $Date; ?></td>
          <td style="min-width:140px;"> <a href="deleteCatagory.php?id=<?php echo $Id;?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a></td>

        </tr>
    </tbody>
        <?php } ?>
    </table>

</div>
</div>

</section>


<!--side area-->

<?php include "include/footer.php"; ?>