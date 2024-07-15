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
        * {
            font-family: 'Poppins', sans-serif;
        }
        .h-font {
            font-family: 'Playfair Display', serif;
        }
        .category-box {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center; /* Center align content */
        }
        .category-box img {
            max-width: 100%; /* Ensure images are responsive */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px;
        }
        .category_name {
            margin-top: 10px;
        }
        .btn-purple {
            background-color: #922bc0;
            border-color: #922bc0;
            color: #fff;
            font-size: larger;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>
<body>
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
            include('config/db.php');
            $id = $_GET['id'];
            $sql = "SELECT hotel_name FROM tbl_tourist_hotels WHERE hotel_id = $id";
            $getHotels = mysqli_query($conn, $sql);
            if(mysqli_num_rows($getHotels) > 0){
                while($row = mysqli_fetch_assoc($getHotels)){
            ?>
            <h2 class="text-center mt-3 text-uppercase"><?php echo $row['hotel_name']; ?></h2>
            <?php
                }
            }
            ?>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 15px;">
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_tourist_rooms WHERE hotel_id = $id";
            $getRooms = mysqli_query($conn, $sql);
            if(mysqli_num_rows($getRooms) > 0){
                while($row = mysqli_fetch_assoc($getRooms)){
            ?>
            <div class="col">
                <div class="category-box">
                    <img src="<?php echo $row['room_image']; ?>" alt="room">
                    <div class="category_name">
                        <span><?php echo $row['room_name']; ?></span>
                    </div>
                    <a href="enroll.php?cat_id=<?php echo $row['hotel_id']; ?>&did=<?php echo $row['room_id']; ?>" class="btn btn-purple mt-2">Book Now</a>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false
            }
        });
    </script>
</body>
</html>
