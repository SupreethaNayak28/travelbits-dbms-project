<?php include('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .cards-container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 70%;
        }
        .custom-card {
    max-width: 90%;
    margin: 15px auto;
     background-color: lightblue ;
    border-radius: 15px;
    overflow: hidden;
    display: flex;
  }

  .custom-card img {
    width: 28%; /* Adjust the width of the image as needed */
    height: auto;
    object-fit: cover;
    border-radius: 15px 0 0 15px;
  }

  .card-body {
    flex: 1;
    padding: 20px;
  }

  .card-body h5,
  .card-body p,
  .card-body small {
    margin: 0;
  }

  .card-title {
    color: #922bc0; /* Set the font color for the title */
    font-size: 30px; /* Set the font size for the title */
    margin-bottom: 10px;
    text-align: center;
  }

  .card-text {
    color: black; /* Set the font color for the text */
    font-size: 18px; /* Set the font size for the text */
    line-height: 2.1;
    font-style: italic;
    /* Set the line height for better readability */
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
  .price {
  font-size: 1.4em;
  font-weight: bold;
  color: #007bff;
  text-decoration: none; /* Remove underline */
  display: inline-block; /* Make it a block-level element */
  vertical-align: middle; /* Adjust the vertical alignment */
  margin-top: 5px; /* Add some top margin for spacing */
}

#sort-dropdown {
  display: block;
  margin: 0 auto;
  padding: 8px;
  font-size: 1em;
  margin-top: 10px;
  text-align: center;
  border: 1px solid #ddd;
  border-radius: 5px;
  background-color: #3498db; /* Background color of the dropdown */
  color: #fff; /* Text color */
}

#sort-dropdown:hover {
  background-color: #2980b9; /* Change background color on hover */
}

#sort-dropdown option {
  padding: 10px;
  font-size: 1em;
  color: black;/* Text color of each option */
  background-color: lightslategray; /* Background color of each option */
}

#sort-dropdown option:hover {
  background-color: black; /* Change background color on hover */
}


</style>


<select id="sort-dropdown">
  <option value="">Sort By</option>
  <option value="price-asc">Price - Ascending</option>
  <option value="price-desc">Price - Descending</option>
</select>

<div class="card-container">
<div class="card mb-3 custom-card">
  <img src="assets/img/karnataka.jpg" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Mysore Palace</h5>
    <p class="card-text">Mysore Palace (Mysuru Palace)—the former home of the Wodeyar family, who ruled the Kingdom of Mysore from 1399 until India’s independence—is an architectural marvel with equally stunning interiors.Though a fire destroyed most of the palace at the end of the 18th century, it was restored in 1912, and today is among the most visited attractions in India.</p>
<a href="mysuru1.php" class="btn">View Destination</a>
<a href="#" class="price">₹100</a>
  </div>
</div>

<div class="card mb-3 custom-card">
  <img src="assets/img/hampi.jpeg" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Hampi</h5>
    <p class="card-text">Hampi or Hampe (Kannada: [hɐmpe]), also referred to as the Group of Monuments at Hampi, is a UNESCO World Heritage Site located in Hampi (City), Ballari district now Vijayanagara district, east-central Karnataka, India.Hampi continues as a religious centre, with the Virupaksha Temple, an active Adi Shankara-linked monastery and various monuments belonging to the old city.</p>
    <a href="hampi.php" class="btn">View Destination</a>
    <a href="#" class="price"> ₹300</a>
  </div>
</div>



<div class="card mb-3 custom-card">
  <img src="assets/img/gol.jpg" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Gol gumbaz</h5>
    <p class="card-text">Gol Gumbaz ('Round Dome'),[1] also written Gol Gumbad,[2] is a 17th-century mausoleum located in Bijapur, a city in Karnataka, India. It houses the remains of Mohammad Adil Shah, seventh sultan of the Adil Shahi dynasty, and some of his relatives.The mausoleum is notable for its scale and exceptionally large dome. </p>
    <a href="gol.php" class="btn">View Destination</a>
    <a href="#" class="price"> ₹200</a>
  </div>
</div>
</div>
<!-- Add this script to the end of your HTML body -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to sort cards by price
    function sortByPrice(order) {
      var cards = $('.custom-card');

      cards.sort(function(a, b) {
        var priceA = parseFloat($(a).find('.price').text().replace('₹', ''));
        var priceB = parseFloat($(b).find('.price').text().replace('₹', ''));

        return order === 'asc' ? priceA - priceB : priceB - priceA;
      });

      $('.card-container').html(cards);
    }

    // Event listener for the dropdown change
    $('#sort-dropdown').change(function() {
      var selectedValue = $(this).val();

      if (selectedValue === 'price-asc') {
        sortByPrice('asc');
      } else if (selectedValue === 'price-desc') {
        sortByPrice('desc');
      }
    });
  });
</script>

</body>
</html>
<?php include('inc/footer.php');?>