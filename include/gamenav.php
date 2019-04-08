<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8" />
    <title>Color Game</title>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.0.5/howler.min.js"></script>
    <script type="text/javascript"src="Script/paper-full.js"></script>
    <link href="css/circles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Animate/Animate.css">

    <script
   src="https://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
 <script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="js/paper.js"></script>

<style media ="screen">
.heading{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: bold;
    color: #005E90;
}
.heading:hover{
    color:#0090DB;
}
</style>
	<style>
	
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: url("images/test3.png");
  background-color: #cccccc;
  height: 618px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

h6 {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: red;
  font-family: cursive;
  font-size: 2rem;

  
}
h5{
  text-align: center;
  position: absolute;
  top: 2%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: rgb(33,44,234);
  font-family: 'Times New Roman', Times, serif;

}
</style>
</head>
<body>

<div class="hero-image animated bounceIn delay-1s">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">

  <a class="navbar-brand animated bounceInRight delay-2s" href="blog.php">
    <img  src="images/Original.jpg" width="60" height="30" class="rounded d-inline-block align-top" alt="">
    {LP} WITH RAHMAT</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ">
     
      <li class="nav-item">
        <a class="nav-link animated bounceInUp delay-2s" href="blog.php?page=1">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link animated bounceInDown delay-1s" href="about.php?page=1">About </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link flipOutY delay-4s" href="contact.php?page=1">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link zoomOut delay-2s active" href="color.php?page=1">Game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bounceIn delay-2s" href="#">Video</a>
      </li>


  </ul>
  <ul class="navbar-nav ml-auto">
  <form class="form-inline d-none d-sm-block" action ="blog.php">
    <input class="form-control mr-sm-2" type="text"name ="Search" placeholder="Search here" value="">
    <button class="btn btn-outline-success my-2 my-sm-0" name ="SearchButton">Search</button>
   
  </form>
  </ul>

</div>
</nav>
<div class="container animated flip delay-3s" style="margin-top:0.3rem;">
  <h5 class="animated  fadeOut delay-2s">Welcome To Color Game</h5>
  <h6 class="animated fadeOut delay-5s"> <i class="fas fa-volume-up"></i> Warning: Do not use full volume</h6>
