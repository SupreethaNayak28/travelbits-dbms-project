<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelBits</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/css/index.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

   <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6fFE00WHqnjZ" crossorigin="anonymous">

<!-- Bootstrap JS (optional, if you want to use Bootstrap's JavaScript features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-iFp3rCRqH06PZl3ZNl1PDApzOfVoFmYfSkLDRbH70F9FDvH4JAwJ8ER9ML+nBao" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6fFE00WHqnjZ" crossorigin="anonymous"></script>
<style> 
/* Style for Guides Section */
/* Style for Guides Section */
.wrapper {
  text-align: center;
  padding: 20px;
}


.row h2 {
  font-size: 32px;
  color: #333;
  margin-top: 45px;
  margin-bottom: 15px;
}

.logo-slider {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.category-box {
  background: #fff;
  border: 1px solid #ddd;
  padding: 20px;
  margin: 20px;
  text-align: center;
  transition: transform 0.3s;
}

.category-box:hover {
  transform: scale(1.05);
}

.category-box img {
  max-width: 100%;
  border-radius: 50%;
}

.hotel-name {
  background: #922bc0;
  color: #fff;
  padding: 15px;
  margin-top: 15px;
  font-size: 18px;
}

/* Style for Tourists Feedback Section */

.row h2 {
  font-size: 32px;
  color: #333;
  margin-top: 45px;
}

.logo-slider {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.category-box {
  background: #fff;
  border: 1px solid #ddd;
  padding: 20px;
  margin: 20px;
  text-align: center;
  transition: transform 0.3s;
}

.category-box:hover {
  transform: scale(1.05);
}

.category-box img {
  max-width: 100%;
  border-radius: 50%;
}

.hotel-name {
  background: #922bc0;
  color: #fff;
  padding: 15px;
  margin-top: 15px;
  font-size: 18px;
}

#exploreButton {
  font-size: 24px; /* Adjust the font size as needed */
  padding: 5px 10px; /* Adjust the padding to increase the button size */
}


</style>
</head>
<body>
<!--About Section start-->
<section class="about" id="about">
  <div class="main-txt">
    <h1>About <span>Us</span></h1>
  </div>
  <div class="row" style="margin-top: 50px;">

  <div class="col-md-6 py-3 py-md-0">
    <div class="card">
      <img src="assets/img/5.jpg" alt="" class="img-fluid">
    </div>
  </div>
  <div class="col-md-6 py-3 py-md-0">
    <h2>How Travel Bits Works</h2>
    <p>Welcome to TravelBits – Your Gateway to Adventure!

      At Travel Bits, we believe that life's most meaningful experiences are often found in the journeys we take. We are passionate about travel and dedicated to helping you discover the wonders of the world, one adventure at a time.Our mission is to inspire and empower travelers like you to explore the beauty and diversity of our planet. We want to provide you with the tools and information you need to plan unforgettable trips that create lifelong memories.<b>Who are we?</b>Travel Bits is a team of experienced and enthusiastic globetrotters, travel writers, and tech-savvy adventurers. We've explored remote corners of the globe, soaked up different cultures, and have an insatiable appetite for discovering new destinations. Our collective experiences have led us to create this platform where we can share our love for travel.</p>
      <button id="exploreButton" class="btn btn-warning">Explore Now</button>

  </div>
</div>
</section>
<!--About Section ends-->
<!--Guides-->
<div class="wrapper" id="guidesSection">
  <div class="row">
    <h2 style="text-align: center;margin-top:45px;margin-bottom:15px;">Meet our team<br>Guides</h2>
  </div>
  <div class="row">
    <div class="logo-slider">
      <?php
      include('config/db.php');
      $sql="select * 
      from guide";
      $getguide=mysqli_query($conn,$sql);
      if(mysqli_num_rows($getguide)>0){
        while($row=mysqli_fetch_assoc($getguide)){
          ?>
            <div class="col-md-6" style="margin-top: 10px;">
            <div class="category-box">
              <img src="<?php echo $row['i_image'];?>" style="width:35%;
              margin:0 auto;
              border-radius:50%;" alt="Trip">
              <div class="hotel-name" style="background:#922bc0;">
             <span style="display: block;color:#FFF;"><?php echo $row['guide_name'];?></span>
             <span style="color:#FFF;">Experience:<?php echo $row ['experience'];?> Years</span>
            
              </div>
            </div>
             
            </div>
          <?php
        }
        }
      ?>
    </div>
  </div>
</div>

<!--Feedback-->
      <div class="container" style="background: #FFF;padding:0px"  id="feedbackSection">
      <div class="row">
  <h2 style="text-align: center;margin-top:45px;">Tourists Feedback</h2>
</div>
         <div class="row">
          <div class="logo-slider">
            <?php
             include('config/db.php');
             $sql = "SELECT tourist.tourist_id, tourist.tourist_name, feedback.feedback, tourist.s_image
        FROM feedback
        JOIN tourist ON tourist.user_id = feedback.user_id";

             $test=mysqli_query($conn,$sql);
             if(mysqli_num_rows($test)>0){
              while($row=mysqli_fetch_assoc($test)){
                ?>
                 <div class="col-md-6" style="margin-top: 10px;">
            <div class="category-box" style="border: 0px;">
              <img src="<?php echo $row['s_image'];?>" style="width: 55%;
              margin:0 auto;
              border-radius:50%;" alt="Trip">

              <div class="hotel-name" style="background:#922bc0;">
            <span style="display: block;color:#FFF;padding:0px 7px;">
          <?php echo $row['feedback'];?></span>
            <span style="color:#fff;font-size:13px !important;">
             <?php echo $row['tourist_name'];?>
             </span>
              </div>
              </div>
                 </div>
             <?php
             }
             }
             ?>
            </div>
         </div>      
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
  // Get references to button and sections
  var exploreButton = document.getElementById("exploreButton");
  var guidesSection = document.getElementById("guidesSection");
  var feedbackSection = document.getElementById("feedbackSection");

  // Hide sections initially
  guidesSection.style.display = "none";
  feedbackSection.style.display = "none";

  // Add click event listener to the button
  exploreButton.addEventListener("click", function () {
    // Toggle visibility of sections
    guidesSection.style.display = guidesSection.style.display === "none" ? "block" : "none";
    feedbackSection.style.display = feedbackSection.style.display === "none" ? "block" : "none";
  });
});
</script>

<?php include('inc/footer.php');?>
</body>
</html>