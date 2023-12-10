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

<!--About Section ends-->
<!--Guides-->
<div class="wrapper" id="guidesSection">
  <div class="row">
    <h2 style="text-align: center;margin-top:45px;margin-bottom:15px;">Guides<br>Book Your own guide!</h2>
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
            <a href="enrollGuide.php?guide_id=<?php echo $row['guide_id']; ?>" class="btn btn-primary btn-lg mt-3">Book Now</a>
            </div>
          <?php
        }
        }
      ?>
    </div>
  </div>
</div>

<?php include('inc/footer.php');?>
</body>
</html>