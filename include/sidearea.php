
        <div class="col-sm-4">
        <div class="card-mt-4">
                    <div id ="cardbody" class="card-body" >
                    <h4 class="lead text-center"> WELCOME  TO {LP} WITH RAHMAT</h4>
                    <img  class="image" src="images/Original.png" class="d-block img-fluid mb-3" alt="">

                    <div class="text-center">
                 <br>
                        <p class="lead"> This is a Coding Blog where I'm going to share my codes and give challenges</p>
                        <p style="color:red">challenge is comming soon  &nbsp;<i class="far fa-smile animated infinite heartBeat delay-3s" style="color: green"></i></p>
                        <small class="text-muted"> Click here to  &nbsp;</small>
                        <a href="about.php"><button type="button" class="btn text-center text-white sm"name="button">Read More</button></a>

                    </div>
             
                    </div>
        </div>

     <div id ="Card" class="card">

          <div class="card-header bg-dark text-light">
          <h2 class="lead text-center">Sign In </h2>
          </div>        
            <div id ="cardbody" class="card-body">
                        <a href="allreg.php"><button type="button" class="btn btn-success btn-block text-center text-white mb-4"name="button"> <i class="far fa-hand-pointer animated infinite zoomOut delay-3s"></i> Join Us</button></a>

                        <a href="signup.php"><button type="button" class="btn btn-danger btn-block text-center text-white mb-4"name="button"><i class="fas fa-sign-in-alt animated infinite zoomIn delay-3s"></i> Logg inn</button> </a>
                        <!--
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" name="" placeholder="Enter your email" value="">
                        <div class="input-group-append">
                          <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                        </div>
                      </div> -->
            </div>
     </div>
        <div id="card-c"class="card">
              <div class="card-header bg-primary text-light">
                      <h2 class="lead text-center"> Categories</h2>
                      </div>

                      <div class="card-body" style="color:white"> 
                        <?php 
                          global $ConnectingDB;
                          $sql="SELECT * FROM category ORDER BY id desc";
                          $stmt =mysqli_query($ConnectingDB, $sql);
                          while($DataRows =mysqli_fetch_assoc($stmt)){
                            $CatagoryId = mysqli_real_escape_string($ConnectingDB,$DataRows['id']);
                            $CatagoryName = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
 
                        ?>

                       <a href="blog.php?catagory=<?php echo  $CatagoryName; ?>"> <span class="heading"> <?php echo $CatagoryName;?></span></a><br>
                          <?php }?>
              </div>
        </div>
<div class="card">
      <div class="card-header bg-info text-white">
        <h2 class="lead txt-center"> Recent Posts</h2>
      </div>
<div class="card-body">
<?php
              global $ConnectingDB;
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= mysqli_query($ConnectingDB, $sql);
              while ($DataRows=mysqli_fetch_assoc($stmt)) {
                $Id     = mysqli_real_escape_string($ConnectingDB,$DataRows['id']);
                $Title  = mysqli_real_escape_string($ConnectingDB,$DataRows['title']);
                $Date = mysqli_real_escape_string($ConnectingDB,$DataRows['date']);
                $Image = mysqli_real_escape_string($ConnectingDB,$DataRows['image']);
              ?>
              <div class="media">
                <img src="upload/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="fullpost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                  <p class="small"><?php echo htmlentities($Date); ?></p>
                </div>
              </div>
              <hr>
              <?php } ?>

</div>
</div>
