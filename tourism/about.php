<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelBits</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/index.css">

    <style> 
        /* Global styles */
        body {
            font-family: Arial, sans-serif; /* Example: Change as needed */
        }

        /* Style for About Section */
        .about {
            padding: 50px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .about h1 {
            font-size: 42px;
            color: #333;
        }

        .about p {
            font-size: 18px;
            color: #666;
        }

        .main-txt {
            margin-bottom: 30px;
        }

        .main-txt h1 span {
            color: #922bc0;
        }

        /* Style for Guides and Feedback Sections */
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
            max-width: 200px; /* Adjust max-width as needed */
        }

        .category-box:hover {
            transform: scale(1.05);
        }

        .category-box img {
            max-width: 100%;
            height: auto; /* Ensures images maintain aspect ratio */
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
            padding: 5px 15px; /* Adjust the padding to increase the button size */
        }
    </style>
</head>
<body>
    <!-- Header Section (you can include this from 'inc/header.php' if needed) -->
    <header>
        <!-- Navbar code goes here (if applicable) -->
    </header>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="main-txt">
                <h1>About <span>Us</span></h1>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <img src="assets/img/5.jpg" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>How Travel Bits Works</h2>
                    <p>Welcome to TravelBits – Your Gateway to Adventure!
                        At Travel Bits, we believe that life's most meaningful experiences are often found in the journeys we take. We are passionate about travel and dedicated to helping you discover the wonders of the India, one adventure at a time. Our mission is to inspire and empower travelers like you to explore the beauty and diversity of our India. We want to provide you with the tools and information you need to plan unforgettable trips that create lifelong memories. Travel Bits is a team of experienced and enthusiastic travel writers, and tech-savvy adventurers. We've explored remote corners of the India, soaked up different cultures, and have an insatiable appetite for discovering new destinations. Our collective experiences have led us to create this platform where we can share our love for travel.</p>
                    <button id="exploreButton" class="btn btn-warning">Explore Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Guides Section -->
    <section class="wrapper" id="guidesSection">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Meet our team<br>Guides</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                include('config/db.php');
                $sql = "SELECT * FROM guide";
                $getguide = mysqli_query($conn, $sql);
                if (mysqli_num_rows($getguide) > 0) {
                    while ($row = mysqli_fetch_assoc($getguide)) {
                ?>
                <div class="col-md-4 col-lg-3">
                    <div class="category-box">
                        <img src="<?php echo $row['i_image'];?>" class="img-fluid rounded-circle" alt="Guide Image">
                        <div class="hotel-name">
                            <span><?php echo $row['guide_name'];?></span><br>
                            <span>Experience: <?php echo $row['experience'];?> Years</span>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="wrapper" id="feedbackSection">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Tourists Feedback</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                $sql = "SELECT tourist.tourist_id, tourist.tourist_name, feedback.feedback, tourist.s_image
                        FROM feedback
                        JOIN tourist ON tourist.user_id = feedback.user_id";
                $getfeedback = mysqli_query($conn, $sql);
                if (mysqli_num_rows($getfeedback) > 0) {
                    while ($row = mysqli_fetch_assoc($getfeedback)) {
                ?>
                <div class="col-md-4 col-lg-3">
                    <div class="category-box">
                        <img src="<?php echo $row['s_image'];?>" class="img-fluid rounded-circle" alt="Tourist Image">
                        <div class="hotel-name">
                            <span><?php echo $row['feedback'];?></span><br>
                            <span><?php echo $row['tourist_name'];?></span>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer Section (you can include this from 'inc/footer.php' if needed) -->
    <footer>
        <!-- Footer code goes here -->
    </footer>

    <!-- Bootstrap JS (optional, if you want to use Bootstrap's JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-iFp3rCRqH06PZl3ZNl1PDApzOfVoFmYfSkLDRbH70F9FDvH4JAwJ8ER9ML+nBao" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></script>
</body>
</html>
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