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
  <img src="assets/img/elephant.png" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Elephanta Caves</h5>
    <p class="card-text">The Elephanta Caves are a collection of cave temples predominantly dedicated to the Hindu god Shiva, which have been designated a UNESCO World Heritage Site.The island, about 2 kilometres (1.2 mi) west of the Jawaharlal Nehru Port, consists of five Hindu caves, a few Buddhist stupa mounds that date back to the 2nd century BCE and two Buddhist caves with water tanks.</p>
<a href="elephant.php" class="btn">View Destination</a>
<a href="#" class="price">₹100</a>
  </div>
</div>

<div class="card mb-3 custom-card">
  <img src="assets/img/tara.jpg" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Taraporewala Aquarium</h5>
    <p class="card-text">Taraporewala Aquarium or Taraporevala Aquarium is India's oldest aquarium and one of Mumbai's main attractions. It hosts marine and freshwater fish. The aquarium is located on Marine Drive.
  The aquarium has a 12-foot long and 180 degree acrylic glass tunnel.The fish are kept in large glass tanks, which will be lit with LED lights.</p>
    <a href="tara.php" class="btn">View Destination</a>
    <a href="#" class="price"> ₹300</a>
  </div>
</div>



<div class="card mb-3 custom-card">
  <img src="assets/img/nehru.jpg" class="img-fluid rounded-start" alt="...">
  <div class="card-body">
    <h5 class="card-title">Nehru Planetarium</h5>
    <p class="card-text">Nehru Planetariums are the five planetariums in India, named after India's first Prime Minister, Jawaharlal Nehru. These are located in Mumbai, New Delhi, Pune and Bangalore, plus there is a Jawahar Planetarium in Allahabad, where Nehru was born.</p>
    <a href="nehru.php" class="btn">View Destination</a>
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