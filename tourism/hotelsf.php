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
        .trend{
            position: absolute;
            top: 17px;
            left: 10px;
            border-radius: 0.5rem;
            padding: 4px 10px;
            font-size: 14px;
            color: #FFF;
            background-color: #c09a2b;
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
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/4.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/5.png" class="w-100 d-block"/>
      </div>
      <div class="swiper-slide">
        <img src="Hotel-Booking-Website-Assets/images/carousel/6.png" class="w-100 d-block"/>
      </div>
    </div>
    
  </div>
    </div>

    <div class="wrapper">
        <div class="row">
            <h2 style="text-align:center;margin-top:30px;">HOTELS</h2>
        </div>
        <div class="row">
            <div class="logo-slider">
            <?php
             $conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
            ?>
            <?php 
            $sql="SELECT * FROM tbl_tourist_hotels";
            $getHotels=mysqli_query($conn,$sql);
            if(mysqli_num_rows($getHotels)>0){
                while($row=mysqli_fetch_assoc($getHotels)){
                    $hotel_id=$row['hotel_id'];

                    ?>
                    <div class="col-md-4" style="margin:10px;">
                    <div class="category-box">
                    <img src="<?php echo $row['hotel_image'];?>"style="width: 85%; margin-left: 14px;" alt="Hotel">
                    <?php if($row["tag_name"]!=null):?>
                        <div class="trend"><?php echo $row['tag_name'];?></div>
                    <?php else:?>
                    <?php endif;?>
                    <div class="category_name">
                        <span style="tourism-Copy/assets/css"><?php echo $row['hotel_name'];?></span>
                    </div>
                    <a href="viewRooms.php?id=<?php echo $hotel_id;?>" class="btn btn-warning" style="background:#922bc0;border-color:#922bc0; font-size:larger;">View Rooms</a>
                    
                </div> 

                    </div>
                    <?php
                }
            }
            ?>

            </div>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    var $= jQuery;
    jQuery(document).ready(function($){
        $('.logo-slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            infinite: true
        });
    });
</script>