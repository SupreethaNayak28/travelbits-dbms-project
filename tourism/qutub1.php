<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<style>
    .card {
  margin-left: 0; /* Set initial margin-left */
}

   .image-container {
  position: relative;
  background-color: lightblue;
}

.img-fluid {
  max-width: 40%;
  height: auto;
  margin: 20px 0 10px 450px; /* Adjust the margin as needed */
}

.text-box {
  width: 30%; /* Adjust the width of the text box as needed */
  height: 100px;
  position: absolute;
  top: 20px; /* Adjust the top position to control the distance from the top */
  left: 2px; /* Adjust the left position to control the distance from the left */
  background-color: lightblue;
  padding: 10px;
  border-radius: 15px 0 0 15px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  line-height: 3.5rem;
  font-size: 20px;
  font-style: italic;
  color: black;
}

.text-box p {
  margin-bottom: 10px; /* Add spacing between paragraphs */
  background-color: lightblue;
}
.text-box h2{
    font-size: 30px;
    color: #922bc0;
    text-align: center;
    background-color: lightblue;
}
.btn {
    display: inline-block;
    padding:5px 20px;
    background-color: #922bc0;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 15px;
    cursor: pointer;
  }
  .card-img-top {
  width: 47%; /* Make the image fill the entire width of the card */
  height: 300px; /* Maintain the image's aspect ratio */
  border-radius: 10px 10px 0 0; /* Add rounded corners to the top */
  object-fit: cover; /* Ensure the image covers the entire container */
}
.map-container {
    width: 90%; /* Adjust the width as needed */
    box-sizing: border-box;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 15px;
    overflow: hidden;
    margin-top: 5px;
    margin-left: 10px;
   margin-bottom: 5px;
  }

  iframe {
    width: 200%;
    height: 285px; /* Adjust the height as needed */
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
  .btn {
    display: inline-block;
    padding:5px 20px;
    background-color: #922bc0;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 10px;
    cursor: pointer;
  }

    </style>

<body>
<div class="image-container">
  <img src="https://upload.wikimedia.org/wikipedia/commons/3/3b/Qutub_Minar_in_the_monsoons.jpg" class="img-fluid" alt="...">
  <div class="text-box">
    <h2>Description</h2>
    <p>The Qutb Minar, also spelled Qutub Minar and Qutab Minar, is a minaret and "victory tower" that forms part of the Qutb complex, which lies at the site of Delhi’s oldest fortified city, Lal Kot, founded by the Tomar Rajputs.[3] It is a UNESCO World Heritage Site in the Mehrauli area of South Delhi, India.
</p>
<a href="https://en.wikipedia.org/wiki/Qutb_Minar" class="btn">Read More!</a>  
<a href="" class="btn">View Hotels!</a>  
</div>
</div>
<div class="col-md-4 py-3" style="position: absolute; top: 67px; left: 1035px;">
  <div class="card" style="width: 42rem;">
  <div class="map-container">
  <?php
$defaultAddress = "Qtab Minar, New Delhi, India"; // Set the default address
$address = $defaultAddress; // Set the address to the default value by default

?>
<iframe width="100%" height="180" src="https://maps.google.com/maps?q=<?php echo urlencode($address); ?>&output=embed"></iframe>

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