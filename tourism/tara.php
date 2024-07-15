<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         .card {
            margin-left: 0; /* Set initial margin-left */
        }

        .image-container {
            position: relative;
            background-color: lightblue;
            text-align: center;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            margin: 20px auto; /* Center the image */
        }

        .text-box {
            width: 80%; /* Adjusted width for normal screens */
            max-width: 400px;
            margin: 20px auto;
            background-color: lightblue;
            padding: 10px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 20px;
            font-style: italic;
            color: black;
        }

        .text-box p {
            margin-bottom: 10px; /* Add spacing between paragraphs */
        }

        .text-box h2 {
            font-size: 30px;
            color: #922bc0;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 5px 20px;
            background-color: #922bc0;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .card-img-top {
            width: 100%;
            height: 200px; /* Decreased height for normal screens */
            border-radius: 10px 10px 0 0;
            object-fit: cover;
        }

        .map-container {
            width: 100%;
            box-sizing: border-box;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 5px;
        }

        iframe {
            width: 100%;
            height: 285px;
            border: none;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media (min-width: 768px) {
            .img-fluid {
                margin: 20px 0 10px 0;
                max-width: 50%;
            }

            .text-box {
                width: 30%;
                position: absolute;
                top: 20px;
                left: 2px;
                border-radius: 15px 0 0 15px;
            }

            .map-container {
                width: 90%;
                margin-left: 10px;
                margin-bottom: 5px;
            }
        }

        @media (min-width: 1024px) {
            .img-fluid {
                margin: 20px 0 10px 450px; /* Adjust the margin as needed */
            }

            .text-box {
                width: 50%;
                max-width: 480px; /* Maximum width if needed */
                position: absolute;
                top: 30px;
                left: 25px;
                border-radius: 15px 0 0 15px;
            }

            .map-container {
                width: 90%;
                margin-left: 10px;
                margin-bottom: 5px;
            }
        }
    </style>
</head>


<body>
<div class="image-container">
  <img src="assets/img/tara1.jpg" width="560px" class="img-fluid" alt="...">
  <div class="text-box">
    <h2>Description</h2>
    <p>Taraporewala Aquarium or Taraporevala Aquarium is India's oldest aquarium and one of Mumbai's main attractions. It hosts marine and freshwater fish. The aquarium is located on Marine Drive.
    The aquarium has a 12-foot long acrylic glass tunnel</p>

<a href="https://en.wikipedia.org/wiki/Taraporewala_Aquarium" class="btn">Read More!</a>  
<a href="hotelsf.php" class="btn">View Hotels!</a>
<a href="touristguides.php" class="btn">Tourist Guide</a>

</div>
</div>
<div class="col-md-4 py-3 py-md-0 mx-auto mt-4">
    <div class="card">
        <div class="map-container">
            <?php
            $defaultAddress = "Taraporewala Aquarium, Mumbai, India"; // Set the default address
            $address = $defaultAddress; // Set the address to the default value by default
            ?>
            <iframe src="https://maps.google.com/maps?q=<?php echo urlencode($address); ?>&output=embed"></iframe>

<form method="POST">
    <p>
        <input type="text" name="address" value="<?php echo $defaultAddress; ?>" readonly>
    </p>
    <input type="submit" name="submit_address" style="display: none;">
</form>

    </div>
  </div>
</div>


</body>
</html>
<?php include('inc/footer.php');?>