<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link rel="stylesheet" type="text/css" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .h-font{
            font-family: 'Playfair Display', serif;
        }
       
    </style>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

</head>
<div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/1.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/2.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/3.png" class="w-100 d-block" />
      </div>
    
  </div>
    </div>

    <div class="row">
    <?php
    $conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
    $id=$_GET['id'];
    $sql="SELECT hotel_name FROM tbl_tourist_hotels where hotel_id=$id";
    $getHotels=mysqli_query($conn,$sql);
    if(mysqli_num_rows($getHotels)>0){
        while($row=mysqli_fetch_assoc($getHotels)){
            ?>
            <h2 style="text-align:center;margin-top:30px;text-transform:uppercase;"><?php echo $row['hotel_name'];?></h2>
            <?php
        }
        ?>
        <?php
    }
    ?>
    </div>
    
    <div class="row" style="padding:15px 15px; width:960px;margin: 0 auto;">
         <?php
         $id=$_GET['id'];
         $sql="SELECT * FROM tbl_tourist_rooms WHERE hotel_id=$id";
         $getRooms=mysqli_query($conn,$sql);
         if(mysqli_num_rows($getRooms)>0){
            while($row=mysqli_fetch_assoc($getRooms)){
                ?>
                <div class="col-md-4" style="margin-top:10px;">
                <div class="category-box">
                    <img src="<?php echo $row['room_image'];?>" style="width: 85%;magin-left:14px;" alt="room"/>
                    <div class="category_name">
                        <span style=""><?php echo $row['room_name'];?></span>
                    </div>
                    <a href="enroll.php?cat_id=<?php echo $row['hotel_id'];?> &did=<?php echo $row['room_id'];?>" class="btn btn-warning" style="background:#922bc0;border-color:#922bc0; font-size:larger;">Book Now</a>
                </div>
                </div>
                <?php
            }
            ?>
            <?php
         }
         ?>

    </div>

<?php include('inc/footer.php');?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop:true,
      autoplay:{
        delay:3500,
        disableonInteraction:false
      }
    });
  </script>