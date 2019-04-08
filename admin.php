<?php include "include/req.php";
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); 
$AdminId = mysqli_real_escape_string($ConnectingDB,$_SESSION["UserId"]);
$sql2 = "SELECT lname FROM admins WHERE id='$AdminId'";
$stmt2 = mysqli_query($ConnectingDB, $sql2);
while ( $datarows=mysqli_fetch_assoc($stmt2) ) {
  $XLastName    = mysqli_real_escape_string($ConnectingDB,$datarows['lname']);
}

if(isset($_POST["Submit"])){
  global $ConnectingDB;
  $FirstName = mysqli_real_escape_string($ConnectingDB,$_POST["Firstname"]);
  $LastName = mysqli_real_escape_string($ConnectingDB,$_POST["Lastname"]);
  $Email = mysqli_real_escape_string($ConnectingDB,$_POST["Email"]);
  $Password = mysqli_real_escape_string($ConnectingDB,$_POST["Password"]);
  $ConfirmPassword = mysqli_real_escape_string($ConnectingDB,$_POST["ConfirmPassword"]);
  $Admin = mysqli_real_escape_string($ConnectingDB,$_SESSION["LastName"]);
  //$Token = bin2hex(openssl_random_pseudo_bytes(40));
  date_default_timezone_set("Europe/Oslo");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
 
  if(empty($FirstName)||empty($LastName)||empty($Email)||empty($Password)||empty($ConfirmPassword)){
    $_SESSION["ErrorMsg"]= "All fields must be filled out";
    Redirect_to("admin.php");
  }elseif($Password!==$ConfirmPassword){
    $_SESSION["ErrorMsg"]= "Password must be the same";
    Redirect_to("admin.php");
  }elseif (strlen($Password)<5) {
    $_SESSION["ErrorMsg"]= "Password should be greater than 5 characters";
    Redirect_to("admin.php");
  }elseif (CheckUserNamenDB($Email)) {
    $_SESSION["ErrorMsg"]= "Email exists, try another one";
    Redirect_to("admin.php");
  }
  else{
    // Query to insert New Admin in DB When everything is fine
    global $ConnectingDB;
    $Hashed_Password = Password_Encryption($Password);
    $stmt =$ConnectingDB->prepare("INSERT INTO admins(date,fname,lname,password,email,aby) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$DateTime,$FirstName,$LastName,$Hashed_Password,$Email,$Admin);
    $Execute=$stmt->execute();
   //  var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMsg"]="New Admin added Successfully";
      Redirect_to("admin.php");
    }else {
      $_SESSION["ErrorMsg"]= "Something went wrong. Try Again !";
      Redirect_to("admin.php");
    }
  }
} //Ending of Submit Button If-Condition
include "include/link.php";
 ?>

<link rel="stylesheet" href="css/style.css">


    <meta charset="utf-8">
    <title>Admin</title>
  </head>
  <body>

    <!--NAVBAR-->
  <?php include "include/header.php"; ?>
      <li class="nav-item ">
        <a class="nav-link animated bounceInLeft delay-3s" href="myprofile.php"><i class="fas fa-user-circle" style="color:green;"></i>&nbsp; <?php echo $XLastName; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="posts.php">Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s " href="Catagories.php">Catagory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="newpost.php">New Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s active" href="admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s " href="insertabout.php">About</a>
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
?>

<form action="admin.php" method="post"> 

    <div class="card">
    <h2 class="text-center"> <i class="fas fa-user-shield" style="color:blue;"></i>&nbsp;Add New Admin</h2>
    <div class="card-body">
      <div class="row">
        <div class="col">
        <div class="form-group">
    <input class="form-control" type="text" name ="Firstname" placeholder="First Name" id="firstname" >
    </div>
        </div>
        <div class="col">
        <div class="form-group">
    <input class="form-control" type="text" name ="Lastname" placeholder="Last Name" id="lastname" >
    </div>
        </div>
      </div>
   
    <div class="form-group">
    <input class="form-control" type="email" name ="Email" placeholder="Email" id="email" >
    </div>
    <div class="form-group">
    <input class="form-control" type="password" name ="Password" placeholder="Passoword" id="Password" >
    </div>
    <div class="form-group">
    <input class="form-control" type="password" name ="ConfirmPassword" placeholder="Confirm Password" id="ConfirmPassword" >
    </div>
    
    <div class="row">
   
    <button type="submit" name="Submit" class="btn btn-success btn-md btn-block mb-1"> <i class="fas fa-user-plus"style="color:blue;"></i> Add Admin</button>
    </div>
    
    <div class="row">
    <button type="button" class="btn btn-outline-info btn-md btn-block flipOutX delay-3s"> <a href="dashboard.php">  <i class="fas fa-undo"></i> Back To Dashboard </a></button>
   

    </div>
    </div>
    </div>
    </form>


    <h2 class="text-white"><i class="fas fa-ellipsis-v" style="color:blue;"></i> Admins List</h2>

<table class="table table-striped table-hover">
    <head class="thead-dark">
        <tr style="color:white">
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </head>
    <?php 
        global $ConnectingDB;
        $sql= "SELECT * FROM admins ORDER BY id asc";
        $Execute =mysqli_query($ConnectingDB,$sql);
        while($DdatRows=mysqli_fetch_assoc($Execute)){
            $Id = $DdatRows['id'];
            $Date =$DdatRows['date'];
            $FirstName =$DdatRows['fname'];
            $LastName =$DdatRows['lname'];
            $Email =$DdatRows['email'];
       
    ?>
    <tbody>
        <tr style="color:snow">
          <td><?php echo $Id; ?></td>
          <td><?php echo $FirstName; ?></td>
          <td><?php echo $LastName; ?></td>
          <th><?php echo $Email; ?></th>
          <td><?php echo $Date; ?></td>


          <td > <a href="deleteAdmin.php?id=<?php echo $Id;?>" class="btn btn-danger"> <i class="far fa-trash-alt" style="color:white;"></i> Delete</a></td>

        </tr>
    </tbody>
        <?php } ?>
    </table>


</div>
</div>

</section>


<!--side area-->
<?php include "include/footer.php"; ?>